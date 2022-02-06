<?php

namespace App\Http\Controllers;
use App\Models\Order;


class OrdersController extends Controller
{
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
    public function index(){
        $orders = Order::active()->paginate(5);
        return view('auth.orders.index', compact('orders'));
    }
    public function order (Order $order){
        $skus = $order->skus()->withTrashed()->get();
        return view('auth.orders.show', compact('order', 'skus'));
    }
}
