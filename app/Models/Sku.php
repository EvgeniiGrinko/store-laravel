<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sku extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'count', 'price'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function skus(){
        return $this->belongsToMany(PropertyOption::class);
    }
}
