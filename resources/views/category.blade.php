@extends('master')
@section('title', 'Категория - '.$category->__('name'))
@section('content')
    <div class="starter-template">
        <h1>
            {{ $category->__('name')}}
        </h1>
    <p>
        {{ $category->__('description')}}
    </p>
    <div class="row">
        @isset($category)

        {{$category->__('name')}}
        @endisset
        @foreach ($category->products->map->skus->flatten() as $sku)
        @include('card', compact('sku'))

        @endforeach

            </div>
    </div>
@endsection
