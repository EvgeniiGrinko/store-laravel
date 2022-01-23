<?php

namespace App\Services;
use App\Models\Currency;
use Carbon\Carbon;

class CurrencyConversion{
    protected static $container;
    public const DEFAULT_CURRENCY_CODE = 'RUB';
    
    public static function loadContainer(){
        if(is_null(self::$container)){
            $currencies = Currency::get();
            foreach($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
        }
        
    }
    public static function getCurrencyFromSession(){
        return session('currencyCode', self::DEFAULT_CURRENCY_CODE);

    }
    public static function getCurrentCurrencyFromSession(){
        self::loadContainer();
        $currencyCode = self::getCurrencyFromSession();
        foreach(self::$container as $currency){
            if($currency->code === $currencyCode){
                return $currency;
            }
        }
    }

    public static function convert($sum, $originCurrencyCode = self::DEFAULT_CURRENCY_CODE, $targetCurrencyCode = null)
    {
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencyCode];

        if ($originCurrency->code != self::DEFAULT_CURRENCY_CODE) {
            if ($originCurrency->rate != 0 || $originCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
                CurrencyRates::getRates();
                self::loadContainer();
                $originCurrency = self::$container[$originCurrencyCode];
            }
        }

        if (is_null($targetCurrencyCode)) {
            $targetCurrencyCode = self::getCurrencyFromSession();
        }

        $targetCurrency = self::$container[$targetCurrencyCode];
        if ($originCurrency->code != self::DEFAULT_CURRENCY_CODE) {
            if ($targetCurrency->rate == 0 || $targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
                CurrencyRates::getRates();
                self::loadContainer();
                $targetCurrency = self::$container[$targetCurrencyCode];
            }
        }

        return $sum / $originCurrency->rate * $targetCurrency->rate;
    }
    public static function getCurrencies() {
        self::loadContainer();
        return self::$container;
    }

    public static function getCurrencySymbol(){
        self::loadContainer();
        $currencyFromSession = self::getCurrencyFromSession(); 
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