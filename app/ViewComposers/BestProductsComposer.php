<?php
namespace App\ViewComposers;

use App\Models\Order;
use App\Models\Sku;
use Illuminate\View\View;

class BestProductsComposer
{
    public function compose(View $view){

        $bestSkusIds = Order::get()->map->skus->flatten()->map->pivot->mapToGroups(function($pivot){
            return [$pivot->sku_id => $pivot->count];
        })->map->sum()->sortDesc()->take(3)->keys()->toArray();
        $bestSkus = Sku::find($bestSkusIds)->sortBy( function ($sku, $key) use ($bestSkusIds) {
            return array_search($sku->id, $bestSkusIds);
        });
        $view->with('bestSkus', $bestSkus);
    }


}
