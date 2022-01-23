<p>Уважаемый {{ $name }}, {{ __('mail.order_created.order_created') }}!</p> 
<p>@lang('mail.order_created.your_order_sum') {{ $fullSum }}</p> 
<table>
    <tbody>
        @foreach($order->products as $product)
        <tr>
            <td>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                    <img height="56px" src="{{Storage::url($product->image)}}">
                    {{$product->__('name')}}
                </a>
            </td>
            <td><span class="badge">{{ $product->countInOrder}}</span>
                <div class="btn-group form-inline">
                    {{ $product->__('description') }}
                </div>
            </td>
            <td>{{ $product->price}} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</td>
            <td>{{ $product->getPriceForCount()}} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}/td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<p>С уважением,</p>
<p>Ваш Internet Store</p>
<p>http://bestgadget.tech/</p>