<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = ['rate'];
    public function scopeByCode($query, $code){
        return $query->where('code', $code);
    }
    public function isMain(){
        return $this->is_main == 1;
    }
}
