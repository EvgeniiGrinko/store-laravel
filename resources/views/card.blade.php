<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($sku->product->isNew())<span class="badge badge-success">Новинка</span>@endif
            @if($sku->product->isRecommended())<span class="badge badge-warning">Рекомендуемые</span>@endif
            @if($sku->product->isHit())<span class="badge badge-danger">Хит продаж</span>@endif
        </div>
        <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku])}}">
            <img src="{{ Storage::url($sku->product->image) }}" alt="{{$sku->product->__('name')}} image">
        </a>
        <div class="caption">
            <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku])}}">
                <h3>{{$sku->product->__('name')}}</h3>
            </a>

                @isset($sku->product->properties)
                    @foreach($sku->propertyOptions as $propertyOption)
                    <h5> {{$propertyOption->property->__('name')}} : <b>{{ $propertyOption->__('name') }}</b></h5>
                    @endforeach
                @endisset

            <p>{{$sku->price}} {{ $currencySymbol }}</p>
            <form action="{{ route('basket-add', $sku)}}" method="POST">
                @if($sku->isAvailable())

                <button type="submit" class="btn btn-primary">@lang('product.add_to_cart')</button>
                @else
                @lang('product.product_soldout')
                @endif
                <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku])}}" class="btn btn-default" role="button">@lang('product.more_info')</a>
                @csrf
            </form>
        </div>
    </div>
</div>
