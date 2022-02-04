<table>
    <tr class="row-header">
        <th height="30" class="column">@lang('basket.photo')</th>
        <th class="column">@lang('basket.product_name')</th>
        <th class="column">@lang('basket.price')</th>
        <th class="column">@lang('basket.count')</th>
        <th class="column">@lang('basket.summ')</th>
        <th class="column">@lang('basket.remove')</th>
    </tr>
    @foreach($products as $product)

        <tr class="row product" data-product-id="{{$product->id}}">   <!-- row  -->
            <td class="column">
                <a href="{{ \App\Http\Services\LangLinkManager::current($product->url) }}"><img
                        src="{{$product->image}}" alt="{{$product->productDescription->name}}"></a>
            </td>
            <td class="column name"><a
                    href="{{ \App\Http\Services\LangLinkManager::current($product->url) }}">{{$product->productDescription->name}}</a>
            </td>
            <td class="column price"><span>{{$product->price}}</span> грн</td>

            <td class="column count">
                <button type="button" class="minus"
                        name="minus"
                        onclick="subtructFromBasket(this, {{$product->id}})">
                    <i class="fas fa-minus"></i>
                </button>

                <input type="text" class="count" name="products[{{$product->id}}]"
                       value="{{$productCounts[$product->id]}}"
                       onchange="setProductCount(this, {{$product->id}})">

                <button type="button" class="plus"
                        name="plus"
                        onclick="addToBasket(this, {{$product->id}})">
                    <i class="fas fa-plus"></i>
                </button>

            </td>

            <td class="column summ"><span>{{ $product->price * $productCounts[$product->id ]}}</span> грн</td>

            <td class="column remove">
                <button type="button" name="remove" onclick="removeFromBasket(this, {{$product->id}})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="6" class="total">@lang('basket.total') <span>{{$total}}</span> грн</td>
    </tr>
</table>
