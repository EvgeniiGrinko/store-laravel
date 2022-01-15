@extends('master')
@section('title', $product->__('name'))
@section('content')
    <div class="starter-template">
        <h1>{{$product->__('name')}}</h1>
        <h2>{{$product->category->__('name')}}</h2>
        <p>Цена: <b>{{$product->price}} ₽</b></p>
        <img src="{{ Storage::url($product->image)}}" height="300" alt="{{$product->__('name')}} image">
        <p>{{$product->__('description')}}</p>
        <p>Количество на складе: <b>{{$product->count > 1 ? $product->count : 0}} шт.</b></p>
        @if($product->isAvailable())
            <form action="{{ route('basket-add', $product)}}" method="POST">
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
            <form action="{{ route('subscription', $product) }}" method="POST">
                @csrf
                <input type="text" name="email">
                <button type="submit">Подписаться на товар</button>
            </form>
        @endif
    </div>
@endsection