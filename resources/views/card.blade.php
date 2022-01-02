<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="{{ Storage::url($product->image) }}" alt="Iphone X">
            <div class="caption">
            <h3>{{$product->name}}</h3>
            <p>{{$product->price ?? ''}} ₽</p>
            <p>
                <form action="{{ route('basket-add', $product)}}" method="POST">
                    <button type="submit" 
                   class="btn btn-primary"
                   role="button">В корзину</button>
                    <a href="{{route('product', [$product->category, $product->code])}}"
                   class="btn btn-default"
                   role="button">Подробнее</a>
                   @csrf
                </form>
                
            </p>
        </div>
    </div>
</div>