@extends('master')
@section('title', 'Корзина')
@section('content')
<div class="starter-template">
            <h1>Корзина</h1>
<p>Оформление заказа</p>
<div class="panel">
<table class="table table-striped">
<thead>
<tr>
<th>Название</th>
<th>Кол-во</th>
<th>Цена</th>
<th>Стоимость</th>
</tr>
</thead>
<tbody>

    @foreach ($order->skus as $sku )
    @if($sku->countInOrder > 0)
    <tr>
        <td>
            <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
            <img height="56px" src="{{Storage::url($sku->product->image)}}">
            {{$sku->product->__('name')}}
            </a>
        </td>
        <td><span class="badge">{{ $sku->countInOrder}}</span>
            <div class="btn-group form-inline">
                <form action="{{route('basket-remove', $sku)}}" method="POST">
                    <button type="submit" class="btn btn-danger">
                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                    </button>
                    @csrf
                </form>
            <form action="{{route('basket-add', $sku)}}" method="POST">
                <button type="submit" class="btn btn-success"
                        ><span
                        class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                @csrf
            </form>

                </div>
    </td>
    <td>{{ $sku->price}} {{ $currencySymbol }}</td>
    <td>{{ $sku->price * ($sku->countInOrder)}} {{ $currencySymbol }}</td>
</tr>
@endif
@endforeach
        <tr>
<td colspan="3">Общая стоимость:</td>
<td>{{ $order->getFullSum() }} {{ $currencySymbol }}</td>
</tr>
</tbody>
</table>
<br>
<div class="btn-group pull-right" role="group">
<a type="button" class="btn btn-success" href="{{ route('basket-place') }}">Оформить заказ</a>
</div>
</div>
</div>
@endsection
