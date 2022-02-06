<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/googled7719b5571da4c6e.html', 'App\Http\Controllers\MainController@google')->name('google');
Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);
Route::get('/locale/{locale}', 'App\Http\Controllers\MainController@changeLocale')->name('locale');
Route::get('/currency/{currency}', 'App\Http\Controllers\MainController@changeCurrency')->name('currency');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');
Route::middleware(['set_locale'])->group(function(){
    Route::get('reset', 'App\Http\Controllers\ResetController@reset')->name('reset');

Route::middleware(['auth'])->group(function(){
    Route::group([
        'prefix' => 'person',
        'namespace' => 'App\Http\Controllers\Person',
        'as' => 'person.'
    ], function () {
        Route::get('/orders','OrderController@index')->name('orders.index');
        Route::get('/orders/{order}','OrderController@order')->name('orders.show');
    });
    Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function(){
        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
        Route::resource('products/{product}/skus', 'SkuController');
        Route::resource('properties', 'PropertyController');
        Route::resource('properties/{property}/property-options', 'PropertyOptionController');
    });
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function(){
            Route::get('/orders','App\Http\Controllers\OrdersController@index')->name('orders');
            Route::get('/orders/{order}','App\Http\Controllers\OrdersController@order')->name('order');

        });

});

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');


Route::get('/','App\Http\Controllers\MainController@index')->name('index');
Route::get('/categories', 'App\Http\Controllers\MainController@categories')->name('categories');

Route::post('subscription/{sku}', 'App\Http\Controllers\MainController@subscribe')->name('subscription');
Route::group(['prefix' => 'basket'], function(){
    Route::post('/add/{sku}', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');
    Route::group(['middleware' => 'basket_not_empty'], function(){
        Route::get('/', 'App\Http\Controllers\BasketController@basket')->name('basket');
        Route::get('/order', 'App\Http\Controllers\BasketController@order')->name('basket-place');
        Route::post('/remove/{sku}', 'App\Http\Controllers\BasketController@basketRemove')->name('basket-remove');
        Route::post('/order', 'App\Http\Controllers\BasketController@orderConfirm')->name('basket-confirm');
    });
});

Route::get('/store/{category}', 'App\Http\Controllers\MainController@category')->name('category');
Route::get('/store/{category}/{product}/{sku}', 'App\Http\Controllers\MainController@sku')->name('sku');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

});

require __DIR__.'/auth.php';
