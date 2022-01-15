@extends('master')
@section('title', 'Все категории')
@section('content')
    <div class="starter-template">
        @foreach($categories as $category)
        <div class="panel">
            <a href="{{ route('category', $category->code) }}">
                <img src="{{ Storage::url($category->image) }}" height="190" alt="{{$category->__('name')}} image">
                <h2>{{ $category->__('name')}}</h2>
            </a>
            <p>
             {{$category->__('description')}}
            </p>
        </div>
        @endforeach
           
            
        </div>
@endsection
