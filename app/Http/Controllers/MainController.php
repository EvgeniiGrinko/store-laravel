<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;


class MainController extends Controller{
    public function index(){
        $products = Product::get();
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
    public function product($category, $product){
        $product2 = Product::where('code', $product)->first();
        // dd($product2);
        return view("product", ['product' => $product], compact('product2'));
    }
};
