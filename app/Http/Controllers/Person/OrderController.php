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
        $products = $order->products()->withTrashed()->get();
        
        return view('auth.orders.show', compact('order', 'products'));
    }
}
