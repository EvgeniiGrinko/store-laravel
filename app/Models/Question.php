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

    public function Answers()
    {
        return $this->hasMany(Answer::class);
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
