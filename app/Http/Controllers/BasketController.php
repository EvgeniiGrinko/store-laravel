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
        if(is_null($orderId)){
            session()->flash('warning', 'Ваша корзина пуста!');
            $products = Product::paginate(6);
            return view("index", compact('products'));
        }
        if (!is_null($orderId)){
            $order = Order::findOrFail($orderId); 
        }
        return view('basket', compact('order'));
    }
    public function orderConfirm(Request $request){
        $orderId = session('orderId');
        if(is_null($orderId)){
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);
       if($success){
           session()->flash('success', 'Ваш заказ принят в обработку!');
           Order::eraseFullSum();
       } else {
           session()->flash('warning', 'Случилась ошибка');
       }
        
        return redirect()->route('index');
    }
    public function order(){
        $orderId = session('orderId');
        if(is_null($orderId)){
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view("order", compact('order'));
    }
    public function basketAdd($productId){
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }
        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update(); 
        } else {
            $order->products()->attach($productId);
        }
        $product = Product::find($productId);
        Order::changeFullSum($product->price);
        session()->flash('success','Добавлен товар '.$product->name);
        if(Auth::check()){
            $order->user_id = Auth::id();
            $order->save();
        }

        return redirect()->route('basket');
        
    }
    public function basketRemove($productId)
    {   
        $orderId = session('orderId');
        $orderSum = session('full_order_sum');
        
            $order = Order::find($orderId);
            if ($order->products->contains($productId)){
                $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
                if($pivotRow->count < 2) {
                    $order->products()->detach($productId);
                } else {
                    $pivotRow->count--;
                    $pivotRow->update(); 
            }
    }
    
        $product = Product::find($productId);
        Order::changeFullSum(-$product->price);
        session()->flash('warning','Удален товар '.$product->name);
        return redirect()->route('basket');
        if (is_null($orderSum)) {
            return redirect()->route('index');
        } 
    } 
} 