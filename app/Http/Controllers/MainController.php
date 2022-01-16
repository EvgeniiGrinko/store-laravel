<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use App\Models\Order;






class MainController extends Controller{
    public function index(Request $request){

        $productsQuery = Product::with('category');
        if ($request->filled('price_from')){
            $productsQuery->where('price', '>=', $request->price_from);
        }if ($request->filled('price_to')){
            $productsQuery->where('price', '<=', $request->price_to);
        }
        if ($request->filled('word')){
            $productsQuery->where('name', 'LIKE', '%'.$request->word.'%');

        }
        foreach(['hit', 'new', 'recommended'] as $field){
            if ($request->has($field)){
                $productsQuery->$field();
            }
        }

        $products = $productsQuery->paginate(6)->withQueryString();
        return view("index", compact('products'));
    }
    public function categories(){
        $categories = Category::get();
        $products = Product::get();
        return view("categories", compact('categories', 'products') );
    }
    public function category($code){

        $category = Category::where('code', $code)->first();
        
        return view('category', compact('category'));
    }
    public function product( $category, $productCode){
        // dd($productCode);
        $product = Product::withTrashed()->byCode($productCode)->firstOrFail();
        // dd($category);   
        return view("product", compact('product', "category"));
    }
    public function subscribe(SubscriptionRequest $request, Product $product){
        Subscription::create(
            [
                'email' => $request->email,
                'product_id' => $product->id,
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
