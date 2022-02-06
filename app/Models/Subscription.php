<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use App\Mail\SendSubscriptionMessage;
use App\Models\Sku;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'sku_id'];

    public function sku() {
        return $this->belongsTo(Sku::class);
    }

    public function scopeActiveBySkuId($query, $skuId){
        return $query->where('status', 0)->where('sku_id', $skuId);

    }
    public static function sendEmailBySubscription(Sku $sku){
        $subscriptions = self::activeBySkuId($sku->id)->get();
            foreach($subscriptions as $subscription){
                Mail::to($subscription->email)->send(new SendSubscriptionMessage($sku));
                $subscription->status = 1;
                $subscription->save();

        }

    }
}
