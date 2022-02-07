@extends('auth.master')

@section('title', 'Купон № ' . $coupon->code)

@section('content')
    <div class="col-md-12">
        <h1>Купон № {{ $coupon->code }}</h1>
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
                <td>{{ $coupon->id}}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $coupon->code }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $coupon->description }}</td>
            </tr>
            <tr>
                <td>Истекает</td>
                <td>@isset($coupon->expired_at){{ $coupon->expired_at->format('d.m.Y') }}@else Срок не установлен @endisset</td>
            </tr>
            <tr>
                <td>Размер скидки</td>
                <td>{{ $coupon->value }} @if($coupon->type === 0)% @endif @isset($coupon->currency){{ $coupon->currency->code }} @endisset</td>
            </tr>
            <tr>
                <td>Абсолютное значение</td>
                <td>@if($coupon->isAbsolute()) Да @else Нет @endif</td>
            </tr>
            <tr>
                <td>Использовать один раз</td>
                <td>@if($coupon->isOnlyOnce()) Да @else Нет @endif</td>
            </tr>
            <tr>
                <td>Использован</td>
                <td>{{$coupon->orders->count()}} </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
