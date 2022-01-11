<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $oldCount = $product->getOriginal('count');
        if($oldCount == 0 && $product->count > 0){
            dd('send subscriptions');
        }
    }

}
