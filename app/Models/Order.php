<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{    use HasFactory;

    protected $fillable = ['user_id', 'currency_id', 'sum'];
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot(['count', 'price'])->withTimestamps();
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function calculateFullSum(){
        $sum = 0;
        foreach($this->products()->withTrashed()->get() as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

  

    public function getFullSum(){
        
        $sum = 0;
        foreach($this->products as $product){
            $sum += $product->price * $product->countInOrder;
        }
        return $sum;
        
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    public function saveOrder($name, $phone){
        $this->name = $name;
        $this->phone = $phone;
        $this->status = 1;
        $this->sum = $this->getFullSum();
        
        $products = $this->products;
        // dd($products );
        $this->save();
        foreach($products as $productInOrder){
            $this->products()->attach($productInOrder, [ 'count' => $productInOrder->countInOrder, 'price' => $productInOrder->price,]);
            
        }
        session()->forget('order');
        return true;
            
    }
}
