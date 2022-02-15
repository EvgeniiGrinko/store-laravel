@extends('auth.master')

@section('title', 'Поставщики')

@section('content')


    <div class="col-md-12">
        <h1>Поставщики</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Код
                </th>
                <th>
                    Имя поставщика
                </th>
                <th>
                    Email
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($merchants as $merchant)
                <tr>
                    <td>{{ $merchant->id}}</td>
                    <td>{{ $merchant->name}}</td>
                    <td>{{ $merchant->email }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('merchants.destroy', $merchant) }}" method="POST">
                                <a class="btn btn-success" type="button"
                                   href="{{ route('merchants.show', $merchant) }}">Открыть</a>
                                <a class="btn btn-warning" type="button"
                                   href="{{ route('merchants.edit', $merchant) }}">Редактировать</a>
                                <a class="btn btn-warning" type="button"
                                   href="{{ route('update_token', $merchant) }}">Обновить Token</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a class="btn btn-success" type="button" href="{{ route('merchants.create') }}">Добавить поставщика</a>
{{--        {{ $merchants->links() }}--}}
    </div>

@endsection
