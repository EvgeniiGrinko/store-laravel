@extends('research.master')

@section('title', 'Опрос ' . $questionnaire->name)

@section('content')
    <div class="row">

        <div class="col-md-12">
            <h1>Опрос - {{ $questionnaire->name }}</h1>
            <table class="table">
            </table>
            <div class="col-sm-6 col-md-4 left">

                @foreach ($questionnaire->questions as $question)
                    <form action="{{route('answer',[$questionnaire, $question, $user])}}" method="POST">
                        @csrf
                        <ol>
                            <li><p>{{$question->question_description}}</p></li>
                            <ul class="">
                                @foreach($question->questionOptions as $questionOption)
                                    <li class="list-inline"><input type=checkbox
                                                                   name="{{$questionOption->id}}"
                                                                   id="{{$questionOption->id}}"
                                                                   value={{$questionOption->value}}
                                                                   @isset($answerOptions)
                                                                   @foreach($answerOptions as $key => $value)
                                                                   @if($value == $questionOption->value) checked @endif
                                            @endforeach
                                            @endisset
                                        >{{$questionOption->option_description}}
                                    </li>
                                @endforeach
                            </ul>
                        </ol>
                        <?php echo '<script>
                            function load(){
                            let options = document.querySelectorAll("input");

                              for(let i = 0; i < options.length; i++){
                                  options[i].onclick = function(event) {
                                      if(options[i].value == 0) {
                                      for(let j = 0; j < options.length; j++){
                                        if (options[j].value != 0) {options[j].checked = false;} }
                                    } else if(options[i].value != 0){
                                    for(let u = 0; u < options.length; u++){
                                        if (options[u].value == 0) {options[u].checked = false;} }
                                    }
                                    }
                               }
                              }
                        </script>';
                        ?>

                        @endforeach
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
