<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Http\Requests\AddCouponRequest;
use App\Models\Coupon;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket())->getOrder();
        return view('basket', compact('order'));
    }
    public function orderConfirm(Request $request){
        $basket = new Basket();
//        dd($basket->getOrder()->coupon, $basket->getOrder()->hasCoupon(), !$basket->getOrder()->coupon->availableForUse());
        if($basket->getOrder()->hasCoupon() && !$basket->getOrder()->coupon->availableForUse()){
            $basket->clearCoupon();

            session()->flash('warning', 'Купон не доступен для использования');
            return redirect()->route('basket');

        }
        $email = Auth::check() ? Auth::user()->email : $request->email;
       if((new Basket())->saveOrder($request->name, $request->phone, $email)){
           session()->flash('success', __('basket.your_order_confirmed'));
       } else {
           session()->flash('warning', 'Товар не доступен для заказа в полном объеме');
       }
        return redirect()->route('index');
    }

    public function order(){

        $basket = new Basket();
        $order = ($basket)->getOrder();
        if(!$basket->countAvailable()){
            session()->flash('warning', 'Товар не доступен для заказа в полном объеме');
            return redirect()->route('basket');
        }
        return view("order", compact('order'));
    }



    public function basketAdd(Sku $sku){

        $result = (new Basket(true))->addSku($sku);
        if ($result) {
            session()->flash('success', 'Добавлен товар '.$sku->product->__('name'));

        }
        else {
            session()->flash('warning', 'Товар '.$sku->product->__('name')." в большем количестве не доступен для заказа");

        }
        return redirect()->route('basket');
    }
    public function basketRemove(Sku $sku)
    {
        (new Basket())->removeProduct($sku);
        session()->flash('warning','Удален товар '.$sku->product->name);
        return redirect()->route('basket');

    }
    public function setCoupon(AddCouponRequest $request){
        $coupon = Coupon::where('code', $request->coupon)->first();
        if($coupon->availableForUse()){
            (new Basket())->setCoupon($coupon);
            session()->flash('success','Был добавлен купон '. $coupon->code);
        } else {
            session()->flash('warning','Купон '. $coupon->code . ' не может быть использован');

        }
        return redirect()->route('basket');
    }



}
