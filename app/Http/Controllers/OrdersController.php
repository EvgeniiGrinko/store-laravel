<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
    public function index(){
        $orders = Order::where('status', 1)->get();
        return view('auth.orders.index', compact('orders'));
    }
    public function order (Order $order){
        
        return view('auth.orders.show', compact('order'));
    }
}
