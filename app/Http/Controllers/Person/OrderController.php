<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Auth::user()->orders()->active()->paginate(5);

        return view('auth.orders.index', compact('orders'));

        
    }
    public function order(Order $order){
        // dd($order->user_id);

        // if(Auth::user()->id !== $order->user_id){
        //     session()->flash('warning', 'У вас нет прав администратора');
        //     $orders = Auth::user()->orders()->where('status', 1)->paginate(10);
        //     return view('auth.orders.index', compact('orders'));
            
        // }
        if (!Auth::user()->orders->contains($order)) {
            return back();
        }
        return view('auth.orders.show', compact('order'));
    }
}
