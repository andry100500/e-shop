<div class="modal-content">
    <div class="header">
        <h2>@lang('basket.h1')</h2>
        <div class="close-modal" onclick="closeModal()">X</div>
    </div>

    <div class="products">

        @foreach($products as $product)
            <div class="row product" data-product-id="{{$product->id}}">   <!-- row  -->
                <div class="column">
                    <a href="{{ \App\Http\Services\LangLinkManager::current($product->url) }}"><img
                            src="{{$product->image}}" alt="{{$product->productDescription->name}}"></a>
                </div>
                <div class="column name"><a
                        href="{{ \App\Http\Services\LangLinkManager::current($product->url) }}">{{$product->productDescription->name}}</a>
                </div>
                <div class="column price"><span>{{$product->price}}</span> грн</div>

                <div class="column count">

                    <button class="subtract" name="subtract">
                        <i class="fas fa-minus"></i>
                    </button>

                    <input type="text" class="count" name="products[{{$product->id}}]"
                           value="{{$productCounts[$product->id]}}">

                    <button class="add" name="add"><i class="fas fa-plus"></i></button>

                </div>

                <div class="column summ"><span>{{ $product->price * $productCounts[$product->id ]}}</span> грн</div>

                <div class="column remove">
                    <button class="remove" name="remove">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        @endforeach

        <div>
            <div class="total">@lang('basket.total') <span>{{$total}}</span> грн</div>
        </div>
    </div>
    <div class="battons">
        <button class="close-modal" class="continue-shopping">@lang('basket.continue_shopping')</button>
        <a href="{{ \App\Http\Services\LangLinkManager::current('/basket/') }}">
            <button class="checkout">@lang('basket.checkout')</button>
        </a>
    </div>
</div>
