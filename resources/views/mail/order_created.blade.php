<p>Уважаемый {{ $name }}</p> 
<p>Ваш заказ на сумму {{ $fullSum }} создан</p> 
<table>
    <tbody>
        @foreach($order->products as $product)
        <tr>
            <td>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                    <img height="56px" src="{{Storage::url($product->image)}}">
                    {{$product->name}}
                </a>
            </td>
            <td><span class="badge">{{ $product->pivot->count}}</span>
                <div class="btn-group form-inline">
                    {{ $product->description }}
                </div>
            </td>
            <td>{{ $product->price}} ₽</td>
            <td>{{ $product->getPriceForCount()}} ₽</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<p>С уважением,</p>
<p>Ваш Internet-Store Mvideo</p>
<p>http://cw88119.tmweb.ru/</p>