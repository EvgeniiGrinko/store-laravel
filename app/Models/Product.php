<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    protected $fillable = ['code', 'name', 'category_id','description', 'image', 'price', 'hit', 'new', 'recommended', 'count', 'name_en', 'description_en'];
    

    public function getCategory() {
        return Category::find($this->category_id);
       
        
    }
    public function isAvailable(){
        return !$this->trashed() && $this->count > 0;
    }

    public function scopeByCode($query, $code) {
        return $query->where('code', $code);
    }

    public function Category() {
        return $this->belongsTo(Category::class);
    }
    public function getPriceForCount(){
        if(!is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function scopeHit($query){
        return $query->where('hit', 1);
    }  
    
    public function scopeNew($query){
        return $query->where('new', 1);
    }  
    
    public function scopeRecommended($query){
        return $query->where('recommended', 1);
    }

    public function setNewAttribute($value){
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    } 

    public function setHitAttribute($value){
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    } 
    
    public function setRecommendedAttribute($value){
        $this->attributes['recommended'] = $value === 'on' ? 1 : 0;
    }

    public function isHit(){
        return $this->hit === 1;
    }
    public function isNew(){
        return $this->new === 1;

    }
    public function isRecommended(){
        return $this->recommended === 1;

    }
}
