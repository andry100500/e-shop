<div class="products">
    <div class="row header">
        <div class="column">@lang('wishlist.photo')</div>
        <div class="column">@lang('wishlist.product_name')</div>
        <div class="column">@lang('wishlist.price')</div>
    </div>

    @foreach($products as $product)
        <div class="row product" data-product-id="{{$product->id}}">
            <div class="column"><a href="{{ \App\Http\Services\LangLinkManager::current($product->url) }}"><img src="{{$product->image}}" alt="{{$product->productDescription->name}}"></a></div>
            <div class="column"><a href="{{ \App\Http\Services\LangLinkManager::current($product->url) }}">{{$product->productDescription->name}}</a></div>
            <div class="column price">{{$product->price}}</div>

            <div class="column">
                <button class="basket-category add-to-basket">
                    <i class="fas fa-shopping-cart"></i>@lang('wishlist.add_to_cart')</button>
                <button name="remove">@lang('wishlist.remove')</button>
            </div>
        </div>
    @endforeach


</div>
