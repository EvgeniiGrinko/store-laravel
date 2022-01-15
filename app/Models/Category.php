<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;
    use HasFactory;
    protected $fillable = ['code', 'name', 'category_id','description', 'image', 'name_en', 'description_en'];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
