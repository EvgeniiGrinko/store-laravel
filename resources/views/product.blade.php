@extends('master')
@section('title', 'Товар')
@section('content')
    <div class="starter-template">
                @if($product->isNew())
                    <span class="badge badge-success">Новинка</span>
                @endif

                @if($product->isRecommended())
                    <span class="badge badge-warning">Рекомендуем</span>
                @endif

                @if($product->isHit())
                    <span class="badge badge-danger">Хит продаж!</span>
                @endif
                            <h1>{{$product->name}}</h1>
    <h2>Мобильные телефоны</h2>
    <p>Цена: <b>71990 ₽</b></p>
    <img src="{{ Storage::url($product->image)}}" height="300px">
    <p>Отличный продвинутый телефон с памятью на 64 gb</p>
    <form action="{{ route('basket-add', $product)}}" method="POST">
        <button type="submit" 
       class="btn btn-primary"
       role="button">В корзину</button>
       @csrf
        </div>
@endsection