<p>Уважаемый {{ $name }}, @lang('order_created.order_created')!</p>
<p>@lang('order_created.your_order_sum') {{ $fullSum }}</p>
<table>
    <tbody>
        @foreach($order->skus as $sku)
        <tr>
            <td>
                <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
                    <img height="56px" src="{{Storage::url($sku->product->image)}}">
                    {{$sku->product->__('name')}}
                </a>
            </td>
            <td><span class="badge">{{ $sku->countInOrder}}</span>
                <div class="btn-group form-inline">
                    {{ $sku->product->__('description') }}
                </div>
            </td>
            <td>{{ $sku->price}} {{ $currencySymbol}}</td>
            <td>{{ $sku->getPriceForCount()}} {{ $currencySymbol }}/td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<p>С уважением,</p>
<p>Ваш Internet Store</p>
<p>http://bestgadget.tech/</p>
