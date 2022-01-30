<?php
namespace App\ViewComposers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class BestProductsComposer
{
    public function compose(View $view){

        $bestProductsIds = Order::get()->map->products->flatten()->map->pivot->mapToGroups(function($pivot){
            return [$pivot->product_id => $pivot->count];
        })->map->sum()->sortDesc()->take(3)->keys()->toArray();
//        $bestProducts = Product::whereIn('id',$bestProductsIds)->get();
//        dd($bestProducts);
        $bestProducts = Product::find($bestProductsIds)->sortBy( function ($product, $key) use ($bestProductsIds) {
            return array_search($product->id, $bestProductsIds);
        });
//        dd($bestProducts);
        $view->with('bestProducts', $bestProducts);
    }


}
