<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($product->isNew())<span class="badge badge-success">Новинка</span>@endif
            @if($product->isRecommended())<span class="badge badge-warning">Рекомендуемые</span>@endif
            @if($product->isHit())<span class="badge badge-danger">Хит продаж</span>@endif
        </div>
        <a href="{{ route('product', [$product->category, $product->code])}}">
            <img src="{{ Storage::url($product->image) }}" alt="Iphone X">
        </a>
            <div class="caption">
            <a href="{{ route('product', [$product->category, $product->code])}}">
                <h3>{{$product->name}}</h3>
            </a>
            <p>{{$product->price}} ₽</p>
            <p>
                <form action="{{ route('basket-add', $product)}}" method="POST">
                    @csrf
                    @if($product->isAvailable())
                    <button type="submit" 
                   class="btn btn-primary"
                   role="button">В корзину</button>
                    @else 
                    Товар распродан
                    @endif
                    <a href="{{ route('product', [$product->category, $product->code])}}"
                   class="btn btn-default"
                   role="button">Подробнее</a>
                </form>
            </p>
        </div>
    </div>
</div>