@extends('front.layout')
@section('meta_title'){{ $product->productDescription->meta_title }}@endsection
@section('meta_description'){{ $product->productDescription->meta_description }}@endsection
@section('meta_keywords'){{ $product->productDescription->meta_keywords }}@endsection

@section('page-content')
    <div class="main-content-product-page">
        @include('front.includes.breadcrumbs')
        <div class="container product" data-product-id="{{$product->id}}">
            <div class="product-left-column">
                <div class="images" id="product-images">
                    @if($additionImages)
                        <div class="small-images">

                            @for($i=0;$i < count($additionImages);$i++)
                                <a href="{{ $additionImages[$i]['bigest'] }}">
                                    <img class="img-circle small-image @if($i === 0) active @endif "
                                         src="{{ $additionImages[$i]['small'] }}"
                                         alt="{{ $product->productDescription->h1 }}">
                                </a>
                            @endfor


                        </div>
                    @endif

                    <div class="main-product-image">
                        <a href="{{ $product->bigImage }}">
                            <img class="big-image" src="{{ $product->mainImage }}"
                                 alt="{{ $product->productDescription->h1 }}">
                        </a>
                    </div>
                </div>
            </div>
            <div class="product-right-column">
                <h1>{{ $product->productDescription->h1 }}</h1>

                @if($product->quantity > 0)
                    <div class="available"><i class="far fa-check-circle"></i>@lang('product.productInStock')</div>

                    <div class="block-buy">
                        <div class="product-price">{{ $product->price }} грн</div>
                        <button class="button-buy add-to-basket" data-product-id="{{$product->id}}"><i
                                class="fas fa-shopping-cart"></i>@lang('product.bayProductButtonText')</button>
                        <div class="product-zakladki"><i class="far fa-heart"></i></div>
                    </div>
                    <div class="product-delivery-and-pay tabs">
                        <input type="radio" id="delivery" name="tabs-1" checked>
                        <label for="delivery">@lang('product.deliveryTab')</label>
                        <input type="radio" id="pay" name="tabs-1">
                        <label for="pay">@lang('product.paymentTab')</label>
                        <section class="tab-content" id="content-delivery">
                            <ul>
                                <li><i class="fas fa-circle"></i>@lang('product.deliveryKiev')</li>
                                <li><i class="fas fa-circle"></i>@lang('product.deliveryUa')</li>
                            </ul>
                        </section>
                        <section class="tab-content" id="content-pay">
                            <ul>
                                <li><i class="fas fa-circle"></i>@lang('product.paymentCashOnDelivery')</li>
                                <li><i class="fas fa-circle"></i>@lang('product.paymentCashToCourier')</li>
                                <li><i class="fas fa-circle"></i>@lang('product.paymentPaymentSystems')</li>
                            </ul>
                        </section>
                    </div>
                @else

                    <div class="not-available"><i class="fas fa-minus-circle"></i>@lang('product.productOutOfStock')
                    </div>
                @endif

                <div class="product-description-and-reviews tabs">
                    <input type="radio" id="description" name="tabs-2" checked>
                    <label for="description">@lang('product.descriptionCharacteristicsTab')</label>
                    <input type="radio" id="reviews" name="tabs-2">
                    <label for="reviews">@lang('product.reviewsQuestionsTab')</label>
                    <section class="tab-content" id="content-description">
                        <ul class="characteristics-item">

                            @foreach($product->characteristicProduct as $characteristicProduct)



                                @if($characteristicProduct->characteristic->status == 1)
                                    <li>
                                        <div
                                            class="characteristics-name">{{ $characteristicProduct->characteristic->characteristicDescriptions->name }}</div>
                                        <div class="dotted-line"></div>
                                        <div class="characteristics-value">{{ $characteristicProduct->text }}</div>
                                    </li>
                                @endif

                            @endforeach
                        </ul>
                        <div class="text-product">{!! $product->productDescription->description !!}</div>
                    </section>
                    <section class="tab-content" id="content-reviews">


                        @if(count($product->reviews) > 0)
                            <div class="btn-new-review">
                                <button class="design-btn-new-review">@lang('product.writeReview')</button>
                            </div>
                        @endif


                        <div class="product-new-review @if(count($product->reviews) > 0) hidden @endif">
                            <form action="{{route('store-review', $product->id)}}" method="post">
                                @csrf
                                <div class="product-raiting-review">
                                    @lang('product.yourMark')
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <label for="name-user-product-review">
                                    @lang('product.yourName')
                                    <input type="text" id="name-user-product-review" name="name">
                                </label><br>

                                <label for="text-review">
                                    @lang('product.yourReview')
                                </label><br>

                                <textarea id="text-review" cols="60" rows="3" name="text"></textarea><br>

                                <label for="positive-side-review">@lang('product.pluses')</label><br>
                                <textarea id="positive-side-review" cols="60" rows="2" name="pluses"></textarea><br>

                                <label for="negative-side-review">@lang('product.minuses')</label><br>
                                <textarea id="negative-side-review" cols="60" rows="2" name="minuses"></textarea><br>

                                <input type="text" hidden name="product_id" value="{{$product->id}}">

                                <button>@lang('product.sentReview')</button>
                            </form>
                        </div>

                        @if(count($product->reviews) > 0)
                            <div class="done-product-reviews">
                                @foreach($product->reviews as $review)
                                    <div class="product-done-review">

                                        <div class="name-user-product-done-review">{{ $review->name }}</div>
                                        <div class="done-product-raiting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="text-product-done-review">{{ $review->text }}</div>
                                        @if($review->pluses)
                                            <div class="done-positive-and-negative-sides-review">
                                                <div><i class="fas fa-plus"></i></div>
                                                <div>
                                                    {{ $review->pluses }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($review->minuses)
                                            <div class="done-positive-and-negative-sides-review">
                                                <div><i class="fas fa-minus"></i></div>
                                                <div>
                                                    {{ $review->minuses }}
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                @endforeach
                            </div>
                        @endif
                    </section>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
    <script src="/js/product.js"></script>
@endsection


@include('front.micromarks.product-sheema')
