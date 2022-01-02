@extends('master')
@section('title', 'Товар')
@section('content')
    <div class="starter-template">
                            <h1>iPhone X 64GB</h1>
                            <h2>{{ $product }}</h2>
    <h2>Мобильные телефоны</h2>
    <p>Цена: <b>71990 ₽</b></p>
    <img src="{{ Storage::url($product2->image)}}" height="300px">
    <p>Отличный продвинутый телефон с памятью на 64 gb</p>

            <form action="https://internet-shop.tmweb.ru/basket/add/1" method="POST">
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>

            <input type="hidden" name="_token" value="CrysFWDZroSXkHJPKAKWiftPtFkgR4wrZQvgn7sg">        </form>
        </div>
@endsection