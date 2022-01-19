<?php

namespace App\Services;
use App\Models\Currency;
use Carbon\Carbon;

class CurrencyConversion{
    protected static $container;
    
    public static function loadContainer(){
        if(is_null(self::$container)){
            $currencies = Currency::get();
            foreach($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
        }
        
    }

    public static function convert($sum, $originCurrencyCode = 'RUB', $targetCurrencyCode = null){
        self::loadContainer();
     $originCurrency = self::$container[$originCurrencyCode];

     if( $originCurrency->updated_at == null || $originCurrency->updated_at->startOfDay() !=  Carbon::now()->startOfDay()){
       CurrencyRates::getRates();
       self::loadContainer();
       $originCurrency = self::$container[$originCurrencyCode];

     };
     if(is_null($targetCurrencyCode)){
         $targetCurrencyCode = session('currencyCode', 'RUB');
     }
     $targetCurrency = self::$container[$targetCurrencyCode];
     if($originCurrency->rate == 0 || $targetCurrency->updated_at == null ||  $targetCurrency->updated_at->startOfDay() !=  Carbon::now()->startOfDay()){
        self::loadContainer();
        $targetCurrency = self::$container[$targetCurrencyCode];
    };
     return $sum / $originCurrency->rate * $targetCurrency->rate ;

    }
    public static function getCurrencies() {
        self::loadContainer();
        return self::$container;
    }

    public static function getCurrencySymbol(){
        self::loadContainer();
        $currencyFromSession = session('currencyCode', 'RUB');
        $currencySumbol = self::$container[$currencyFromSession]->symbol;
        return $currencySumbol;
    }
    public static function getBaseCurrency(){
        self::loadContainer();
        foreach(self::$container as $code => $currency){
            if($currency->isMain()){
                return $currency;
            }
        }

    }
}