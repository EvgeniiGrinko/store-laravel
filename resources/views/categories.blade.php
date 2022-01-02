@extends('master')
@section('title', 'Все категории')
@section('content')
    <div class="starter-template">
        @foreach($categories as $category)
        <div class="panel">
            <a href="{{ route('category', $category->code) }}">
                <img src="{{ Storage::url($category->image) }}" height="190px">
                <h2>{{ $category->name}}</h2>
            </a>
            <p>
             {{ $category->description}}
            </p>
        </div>
        @endforeach
           
            
        </div>
@endsection
