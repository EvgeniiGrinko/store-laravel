<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function questionOptions()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public static function mix($words)
    {
        $result = [];
//количество элементов массива
        $n = count($words);
//ищем факториал
        $f = 1;
        for ($i = 1; $i <= $n; $i++) $f = $f * $i;{
        for ($i = 0; $i < $f; $i++) {
            $pos = $i % ($n - 1);
            if ($pos == 0) $first = array_shift($words);
            $result[$i] = [];
            for ($j = 0; $j < $n - 1; $j++) {
                if ($j == $pos) $result[$i][] = $first;
                $result[$i][] = $words[$j];
            }
            if ($pos == ($n - 2)) {
                $words[] = $first;
            }
        }
    }


        return ($result);
    }

    public function combinations()
    {
        $values = [];

        foreach ($this->questionOptions as $option) {
            if ($option->value != 0) {
                $values[] = $option->value;
            }
        }

        return $values;
    }
}
