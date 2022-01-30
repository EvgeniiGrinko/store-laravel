<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($product->isNew())<span class="badge badge-success">Новинка</span>@endif
            @if($product->isRecommended())<span class="badge badge-warning">Рекомендуемые</span>@endif
            @if($product->isHit())<span class="badge badge-danger">Хит продаж</span>@endif
        </div>
        <a href="{{ route('product', [$product->category, $product->code])}}">
            <img src="{{ Storage::url($product->image) }}" alt="{{$product->__('name')}} image">
        </a>
        <div class="caption">
            <a href="{{ route('product', [$product->category, $product->code])}}">
                <h3>{{$product->__('name')}}</h3>
            </a>
            <p>{{$product->price}} {{ $currencySymbol }}</p>
            <form action="{{ route('basket-add', $product)}}" method="POST">
                @if($product->isAvailable())
                <button type="submit" class="btn btn-primary">@lang('product.add_to_cart')</button>
                @else
                @lang('product.product_soldout')
                @endif
                <a href="{{ route('product', [$product->category, $product->code])}}" class="btn btn-default" role="button">@lang('product.more_info')</a>
                @csrf
            </form>
        </div>
    </div>
</div>
