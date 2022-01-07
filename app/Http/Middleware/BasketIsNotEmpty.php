<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
        public function handle($request, Closure $next)
        {
            $orderId = session('orderId');

            if (!is_null($orderId) && Order::getFullSum() > 0) {
                return $next($request);
            }
            
            session()->forget('full_order_sum');
            session()->flash('warning', 'Ваша корзина пуста');
            return redirect()->route('index');
        }
    }

