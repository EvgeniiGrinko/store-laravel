<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;





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
};
