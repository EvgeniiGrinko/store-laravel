<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, Translatable, SoftDeletes;
    protected $fillable = ['name', 'name_en'];
    public function propertyOptions()
        {
            return $this->hasMany(PropertyOption::class);
        }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
