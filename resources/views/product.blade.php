@extends('master')
@section('title', $product->name)
@section('content')
    <div class="starter-template">
        <h1>{{$product->name}}</h1>
        <h2>{{$product->category->name}}</h2>
        <p>Цена: <b>{{$product->price}} ₽</b></p>
        <img src="{{ Storage::url($product->image)}}" height="300" alt="{{$product->name}} image">
        <p>{{$product->description}}</p>
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
        <form action="{{ route('subscription', $product) }}" method="POST">
            @csrf
            <input type="text" name="email">
            <button type="submit">Подписаться на товар</button>
        </form>
        @endif
        </div>
@endsection