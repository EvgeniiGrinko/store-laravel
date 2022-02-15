<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Sku;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use App\Models\Order;
use App\Services\CurrencyRates;







class MainController extends Controller{
    public function index(Request $request){
        $skusQuery = Sku::with('product', 'product.category');
        if ($request->filled('price_from')){
            $skusQuery->where('price', '>=', $request->price_from);
        }if ($request->filled('price_to')){
            $skusQuery->where('price', '<=', $request->price_to);
        }
        if ($request->filled('word')){

            $skusQuery->whereHas('product', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->word.'%');
            })->get();
        }
        foreach(['hit', 'new', 'recommended'] as $field){
            if ($request->has($field)){
                $skusQuery->whereHas('product', function (Builder $query) use ($field) {
                    $query->where($field,'=',1);
            })->get();
            }
        }
        $skus = $skusQuery->paginate(6)->withQueryString();
        return view("index", compact('skus'));
    }
    public function categories(){
        $categories = Category::get();
        $products = Product::get();
        return view("categories", compact('products', 'categories') );
    }
    public function category($code){

        $category = Category::where('code', $code)->first();

        return view('category', compact('category'));
    }
    public function sku( $categoryCode, $productCode, Sku $sku){

        if ($sku->product->code != $productCode){
            abort(404, 'Product not found');
        }

        if ($sku->product->category->code != $categoryCode){
            abort(404, 'Category not found');
        }

        return view("product", compact( 'sku'));
    }
    public function subscribe(SubscriptionRequest $request, Sku $sku){
        Subscription::create(
            [
                'email' => $request->email,
                'sku_id' => $sku->id,
            ]
            );
        return redirect()->back()->with('success', 'Вы были успешно подписаны на продукт. Мы сообщим вам о поступлении о его поступлении.');
    }
    public function google(){
        return redirect(Storage::url('google/googled7719b5571da4c6e.html'));
    }

    public function changeLocale($locale){
        $availableLocales = ['ru', 'en',];
        if(!in_array($locale, $availableLocales)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();

    }
    public function changeCurrency($currencyCode){

         $currency = Currency::byCode($currencyCode)->firstOrfail();

         session(['currencyCode' => $currency->code]);
         return redirect()->back();
    }
};
