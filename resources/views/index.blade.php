@extends('master')
@section('title', 'Главная')
@section('content')
    <div class="starter-template">
        <h1>@lang('main.all_products')</h1>
        <form method="GET" action="{{route("index")}}">
            <div class="filters row">
                <div class="col-sm-6 col-md-3">
                    <label for="price_from">@lang('main.price_from')
                        <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from}}">
                    </label>
                    <label for="price_to">@lang('main.price_to')
                        <input type="text" name="price_to" id="price_to" size="6"  value="{{ request()->price_to }}">
                    </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="hit">
                        <input type="checkbox" name="hit" id="hit" @if(request()->has('hit')) checked @endif> @lang('main.properties.hit')
                    </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="new">
                        <input type="checkbox" name="new" id="new" @if(request()->has('new')) checked @endif> @lang('main.properties.new')
                    </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="recommended">
                        <input type="checkbox" name="recommended" id="recommended" @if(request()->has('recommended')) checked @endif> @lang('main.properties.recommend')
                    </label>
                </div>
                <div class="col-sm-6 col-md-3">
                    <label for="word">@lang('main.contains_in_name')
                        <input type="text" name="word" id="word" size="15"  value="{{ request()->word }}">
                    </label>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-primary">@lang('main.filter')
                    </button>
                    <a href="{{ route("index") }}" class="btn btn-warning">@lang('main.reset')
                    </a>
                </div>
            </div>
        </form>
    <div class="row">
        @foreach ($skus as $sku)
        @include('card', compact('sku'))
        @endforeach
    </div>
    {{ $skus->links()}}
</div>
@endsection
