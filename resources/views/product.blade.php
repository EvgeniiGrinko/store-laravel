@extends('master')
@section('title', $sku->product->__('name'))
@section('content')
    <div class="starter-template">
        <h1>{{$sku->product->__('name')}}</h1>
        <h2>{{$sku->product->category->__('name')}}</h2>
        <p>Цена: <b>{{$sku->price}} {{ $currencySymbol }}</b></p>
        @isset($sku->product->properties)
            @foreach($sku->propertyOptions as $propertyOption)
                <h5> {{$propertyOption->property->__('name')}} : <b>{{ $propertyOption->__('name') }}</b></h5>
            @endforeach
        @endisset
        <img src="{{ Storage::url($sku->product->image)}}" height="300" alt="{{$sku->product->__('name')}} image">
        <p>{{$sku->product->__('description')}}</p>
        <p>Количество на складе: <b>{{$sku->count > 1 ? $sku->count : 0}} шт.</b></p>
        @if($sku->isAvailable())
            <form action="{{ route('basket-add', $sku->product)}}" method="POST">
            <button type="submit"
            class="btn btn-success">Добавить в корзину</button>
            @csrf
            </form>
        @else
            <span>Товар распродан</span>
            <br>
            <span>Сообщить мне когда товар станет доступен</span>
            <div class="warning">@if ($errors->get('email'))
                {!! $errors->get('email')[0] !!}
            @endif</div>
{{--        {{dd($sku->id);}}--}}
            <form action="{{ route('subscription', $sku) }}" method="POST">
                @csrf
                <input type="text" name="email">
                <button type="submit">Подписаться на товар</button>
            </form>
        @endif
    </div>
@endsection
