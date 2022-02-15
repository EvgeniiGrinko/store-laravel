<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['answer', 'question_id', 'questionnaire_id', 'user_id'];

    public function findGivenAnswers($questionId)
    {
        $question = Question::where('id',$questionId)->first();
        $combinations = $question->combinations();

        $answer = $this->answer;


        usort($combinations, function ($a, $b)
        {
            if ($a == $b) {
                return 0;
            }
            return ($a > $b) ? -1 : 1;
        });
        $data = [];

        $result = self::recursive($answer, $combinations, $data );
        $tmp = [];
        foreach ($result as $k => $v) {
            if (array_key_exists($v, $tmp)) {
                unset($result[$k]);
            } else {
                $tmp[$v] = true;
            }
        }
        dd($result);




    }

    public static function recursive($answer, $combinations,  & $data)
    {



        for($i = 0; $i < count($combinations); $i++){
            if($answer == 0 ){
                $data[] = $answer;
                return $data;

            } else if($answer > $combinations[$i]) {
                array_push($data, $combinations[$i]);
                $answer -= $combinations[$i];
                self::recursive($answer,$combinations, $data);
            }else if($answer % $combinations[$i] == 0) {

                array_push($data, $combinations[$i]);
                return $data;
            } else if($answer < $combinations[$i]) {
                continue;
            }
        }




    }
}
