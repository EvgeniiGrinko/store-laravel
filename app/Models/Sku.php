<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sku extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    protected $fillable = ['product_id', 'count', 'price'];
    protected $visible = [ 'id', 'count', 'price', 'product_name', 'options'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function getPriceForCount(){
        if(!is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }
    public function propertyOptions(){
        return $this->belongsToMany(PropertyOption::class, 'sku_property_option')->withTimestamps();
    }

    public function isAvailable(){
//        dd(!$this->product->trashed() && $this->count > 0);
        return !$this->product->trashed() && $this->count > 0;
    }
    public function getPriceAttribute(){
        return round(CurrencyConversion::convert( $this->attributes["price"]),2);
    }

    public function scopeAvailable($query)
    {
        return $query->where('count', '>', 0);
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }
    public function getOptionsAttribute()
    {
        $collections = $this->propertyOptions()->get();
        $options = [];
        foreach ($collections as $option) {
            $options[] = $option->name_en;
        }
        return $options;


    }
}
