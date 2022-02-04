<div class="product" data-product-id="{{$product->id}}">
    <a href="{{ \App\Http\Services\LangLinkManager::current($product->url) }}" class="image-product-category">
        <img src="{{ $product->image }}" alt="{{$product->productDescription->name}}">
    </a>

    <p class="name-product-category">
        <a href="{{ \App\Http\Services\LangLinkManager::current($product->url) }}">{{$product->productDescription->name}}</a>
    </p>

    <p class="price">{{$product->price}} грн</p>

    <div class="btn-product-category">


        <button class="basket-category add-to-basket">
          <i class="fas fa-shopping-cart"></i> @lang('category.bayCategoryButtonText')
        </button>


        <button class="wishlist add-to-wishlist">
          <i class="far fa-heart"></i>
        </button>
    </div>
</div>
