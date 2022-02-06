@extends('auth.master')

@section('title', 'Sku ' . $sku->name)

@section('content')
    <div class="col-md-12">
        <h1>Sku {{ $sku->product->name }}</h1>
        <h2>{{ $sku->propertyoptions->map->name->implode(', ') }}</h2>
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
                <td>{{ $sku->id }}</td>
            </tr>
            <tr>
                <td>Цена</td>
                <td>{{ $sku->price }}</td>
            </tr>
            <tr>
                <td>Количество</td>
                <td>{{ $sku->count }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
