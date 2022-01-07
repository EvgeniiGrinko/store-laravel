@extends('master')
@section('title', $product->name)
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
    <p>Цена: <b>{{$product->price}} ₽</b></p>
    <img src="{{ Storage::url($product->image)}}" height="300px">
    <p>{{$product->description}}</p>
    @if($product->isAvailable())
    <p>Количество на складе: <b>{{$product->count}} шт.</b></p>
    <form action="{{ route('basket-add', $product)}}" method="POST">
        @csrf
        <button type="submit" 
       class="btn btn-success"
       role="button">В корзину</button>
        @else 
        Товар распродан
        @endif
        
    </form>    

        </div>
      
@endsection