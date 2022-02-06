<?php

namespace App\Observers;

use App\Models\Sku;
use App\Models\Subscription;

class ProductObserver
{
    /**
     *
     * @param Sku $sku
     * @return void
     */
    public function updating(Sku $sku)
   {
//   dd(123);
        $oldCount = $sku->getOriginal('count');
        if($oldCount == 0 && $sku->count > 0){
            Subscription::sendEmailBySubscription($sku);
        }
    }


}
