<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\CurrencyConversion;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['master', 'categories'],'App\ViewComposers\CategoriesComposer');
        View::composer(['master'],'App\ViewComposers\CurrenciesComposer');
        View::composer(['master'],'App\ViewComposers\BestProductsComposer');
        View::composer(['*'],function($view){
            $currencySymbol = CurrencyConversion::getCurrencySymbol();
            $view->with('currencySymbol', $currencySymbol);

        });
        // View::composer(['*'],'App\ViewComposers\BestProductsComposer');


    }
}
