<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class ResearchController extends Controller
{
    public function index()
    {

        $questionnaires = Questionnaire::get();
     return view('research.index', compact('questionnaires'));
    }
    public function show( Questionnaire $questionnaire)
    {
    $user = Auth::user();
     return view('research.show', ['questionnaire' => $questionnaire, 'user' => $user]);
    }
    public function answer( Request $request, Questionnaire $questionnaire, Question $question, User $user)
    {
        $params  = $request->all();
        unset($params['_token']);
        if($params == []){
            session()->flash('warning', 'Необходимо выбрать хотя бы один вариант ответа');
            return redirect()->back();

        };
        $number = 0;
        foreach ($params as $key => $value) {
            $number += $value;
        }
//        dd($number);
        $data = [];
        $data['answer'] = $number;
        $data['user_id'] = $user->id;
        $data['questionnaire_id'] = $questionnaire->id;
        $data['question_id'] = $question->id;
        $answer = Answer::create($data);
        $answer->findGivenAnswers($question->id);


        return redirect()->route('questionnaires');
    }
}
