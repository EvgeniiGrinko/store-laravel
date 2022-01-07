<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId); 
        return view('basket', compact('order'));
    }
    public function orderConfirm(Request $request){
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);
        $success = $order->saveOrder($request->name, $request->phone);
       if($success){
           session()->flash('success', 'Ваш заказ принят в обработку!');
       } else {
           session()->flash('warning', 'Случилась ошибка');
       }
       Order::eraseFullSum();
        return redirect()->route('index');
    }

    public function order(){
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);
        return view("order", compact('order'));
    }

    public function basketAdd( Product $product){  
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::findOrFail($orderId);
        }
        if ($order->products->contains($product->id)){
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update(); 
        } else {
            $order->products()->attach($product->id);
        }
        if(Auth::check()){
            $order->user_id = Auth::id();
            $order->save();
        }
      
        Order::changeFullSum($product->price);
        session()->flash('success', 'Добавлен товар'.$product->name);
        return redirect()->route('basket');
    }
    public function basketRemove(Product $product)
    {   
        $orderId = session('orderId');        
        $order = Order::findOrFail($orderId);
        
        if ($order->products->contains($product->id)){
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;
            if($pivotRow->count < 2) {
                $order->products()->detach($product->id);
            } else {
                $pivotRow->count--;
                $pivotRow->update(); 
        }
    }
    
        Order::changeFullSum(-$product->price);
        session()->flash('warning','Удален товар '.$product->name);
        return redirect()->route('basket');

    } 
} 