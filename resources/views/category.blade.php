@extends('master')
@section('title', 'Категория - '.$category->__('name'))
@section('content')
    <div class="starter-template">
        <h1>
            {{ $category->__('name')}} 
        </h1>
        <p>
            {{ $category->products->count()}} продукта в этой категории
        </p>
    <p>
        {{ $category->__('description')}}
    </p>
    <div class="row">
        @isset($category)
       
        {{$category->__('name')}}
        @endisset
        @foreach ($category->products as $product)
        @include('card', compact('product'))
        
        @endforeach

            </div>
    </div>
@endsection