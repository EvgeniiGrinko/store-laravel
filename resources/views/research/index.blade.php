@extends('research.master')

@section('title', 'Опросы ')

@section('content')
    <div class="col-md-12">
        <h1>Опросы</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Название опроса
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($questionnaires as $questionnaire)
                <tr>
                    <td>{{ $questionnaire->id }}</td>
                    <td>{{ $questionnaire->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('questionnaire', $questionnaire)}}" method="GET">
                                    <button type="submit" class="btn btn-primary">Пройти тест</button>
                                @csrf
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
