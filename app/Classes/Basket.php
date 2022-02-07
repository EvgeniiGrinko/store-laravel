<?php

namespace App\Classes;
use App\Http\Requests\AddCouponRequest;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;
use App\Services\CurrencyConversion;
use Error;

class Basket {
    protected $order;

    public function __construct($createOrder = false){

        $order = session('order');
        session(['order' => $order]);
        try{
            $order->currency_id =CurrencyConversion::getCurrentCurrencyFromSession()->id ;

        } catch(Error){

        }
        // dd($order);
        if (is_null($order) && $createOrder ) {
            $data = [];
            if(Auth::check()){
                $data['user_id'] = Auth::id();
            }
            $data['currency_id'] = CurrencyConversion::getCurrentCurrencyFromSession()->id;
            $this->order = new Order($data);
            session(['order' => $this->order]);
        } else {
            $this->order = $order;
        }

    }
    public function clearCoupon()
    {

        $this->order->coupon()->dissociate();
    }

    public function getOrder(){
        return $this->order;
    }

    public function countAvailable($updateCount = false){
        foreach($this->order->skus as $orderSku){
            if($orderSku->countInOrder > $orderSku->count){
                return false;
            }
            if ($updateCount) {

                $orderSku->count -= $orderSku->countInOrder;
                Sku::where('product_id', $orderSku->product->id)->first()->update(['count' => $orderSku->count]);
            }}


        return true;
    }
    public function setCoupon(Coupon $coupon){
        $this->order->coupon()->associate($coupon);
    }
    public function saveOrder($name, $phone, $email) {

        if (!$this->countAvailable(true)){
            return false;
        }
        $this->order->saveOrder($name, $phone);
        Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));
         return true;
    }


    public function removeProduct(Sku $sku){
        if ($this->order->skus->contains($sku)){
            $pivotRow = $this->order->skus->where('id', $sku->id)->first();
            if($pivotRow->countInOrder < 2) {
                $collection = $this->order->skus;
                foreach ($collection as $key => $item) {
                if ($item->name == $sku->name) {
                 $collection->pull($key);
                    }
                }
            } else {
                $pivotRow->countInOrder--;
            }
        }
    }

    public function addSku(Sku $sku){
        if ($this->order->skus->contains($sku)){
            $pivotRow = $this->order->skus->where('id', $sku->id)->first();
            if ($pivotRow->countInOrder >= $sku->count){
                return false;
            }
            $pivotRow->countInOrder++;
        } else {
            if($sku->count == 0) {
                return false;
            }
            $sku->countInOrder = 1;
            $this->order->skus->push($sku);
        }
              return true;
    }
}


