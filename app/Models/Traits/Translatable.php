<?php

namespace App\Models\Traits;
use Illuminate\Support\Facades\App;
use LogicException;

Trait Translatable {
    protected $defaultLocale = 'ru';
    public function __($originFieldName)     {
    $locale = App::getLocale() ?? $this->defaultLocale;

        if($locale === 'en'){
            $fieldName = $originFieldName .  '_en';
        } else {
            $fieldName = $originFieldName;
        }
            $attributesKeys = array_keys($this->attributes);
        if(!in_array($fieldName, $attributesKeys)){
            throw new LogicException("No such atrribute in model: " . get_class($this));
        }
 
        if($locale === 'en' && (is_null($this->$fieldName) || empty($this->$fieldName))){
            return $this->$originFieldName;
        }
      
        return $this->$fieldName;
    } 
}