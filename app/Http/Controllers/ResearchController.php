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

    public function show(Questionnaire $questionnaire)
    {
        $user = Auth::user();
        $answer = false;
        try {
            $answer = Answer::where('user_id', $user->id)->first();
        } catch (Exception $e) {
        }
        if ($answer) {
            $answerOptions = $answer->findGivenAnswers($answer->question->id);
            session()->flash('success', 'Вы уже отвечали на вопрос ' . $answer->question->question_description . '. Ранее предоставленные ответы проставлены в соответствующих полях. Вы можете изменить свои ответы, новые данные будут сохранены после отправки формы');
            return view('research.show', ['questionnaire' => $questionnaire, 'user' => $user, 'answerOptions' => $answerOptions]);

        };
        return view('research.show', ['questionnaire' => $questionnaire, 'user' => $user]);
    }

    public function answer(Request $request, Questionnaire $questionnaire, Question $question, User $user)
    {

        $params = $request->all();
        unset($params['_token']);
        if ($params == []) {
            session()->flash('warning', 'Необходимо выбрать хотя бы один вариант ответа');
            return redirect()->back();

        } else if ($params) {

            foreach ($params as $key => $value) {
                if (!is_numeric($value)) {
                    session()->flash('warning', 'Запрещено менять значения в коде.');
                    return redirect()->back();
                }
                foreach ($question->questionOptions as $questionOption) {
                    if (($questionOption->value != $value && $questionOption->id == $key) || (($questionOption->value == $value && $questionOption->id != $key))) {
                        session()->flash('warning', 'Запрещено менять значения в коде.');
                        return redirect()->back();
                    }
                }
            }
        };
        $number = 0;
        foreach ($params as $key => $value) {
            $number += $value;
        }
        $data = [];
        $data['answer'] = $number;
        $data['user_id'] = $user->id;
        $data['questionnaire_id'] = $questionnaire->id;
        $data['question_id'] = $question->id;
        $user = Auth::user();
        $answer = false;
        try {
            $answer = Answer::where('user_id', $user->id)->first();
        } catch (Exception $e) {
        }
        if ($answer) {
            $answer->update($data);

        } else {
            $answer = Answer::create($data);
        }
        return redirect()->route('questionnaires');
    }
}
