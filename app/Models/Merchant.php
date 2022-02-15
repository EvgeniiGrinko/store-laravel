<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class Merchant extends Authenticatable
{
    use HasFactory, HasApiTokens,  Notifiable;
    protected $fillable = ['name', 'email', 'api_token'];

    public function createTokenForApi()
    {
        $this->tokens()->delete();
        $newToken = $this->createToken('api_token')->plainTextToken;
        $this->api_token = $this->tokens[0]->token;
        $this->save();
        return $newToken;
    }
}
