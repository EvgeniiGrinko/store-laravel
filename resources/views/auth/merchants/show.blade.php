@extends('auth.master')

@section('title', 'Поставщик ' . $merchant->name)

@section('content')
    <div class="col-md-12">
        <h1>{{ $merchant->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $merchant->id}}</td>
            </tr>
            <tr>
                <td>Имя</td>
                <td>{{ $merchant->name }}</td>
            </tr>

            <tr>
                <td>API Token</td>
                <td>{{ $merchant->api_token }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
