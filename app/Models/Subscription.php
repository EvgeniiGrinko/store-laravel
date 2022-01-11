<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'product_id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function scopeActiveProductId($query, $productId){
        return $query->where('active', 0)->where('product_id', $productId);
        
    }
}
