@extends('front.layout')
@section('meta_title') @lang('basket.meta_title') @endsection
@section('meta_description') @lang('basket.meta_description')  @endsection
@section('meta_keywords') @lang('basket.meta_keywords')  @endsection

@section('page-content')

    <div class="main-content container" id="basket">

        @include('front.includes.breadcrumbs')

        <h1>@lang('basket.h1') </h1>

        <div class="content">
            @if($errors->any())
                <div class="alert">
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(count($products)>0)

                <form action="{{\App\Http\Services\LangLinkManager::current('/basket/make-order')}}" method="post">

                    @csrf
                    <div class="products">
                        @include('front.basket.basket-page-products-list')
                    </div>


                    {{--order data--}}
                    <div class="order-data">
                        <h2>@lang('basket.bayer_data'):</h2>
                        <div class="fields">
                            <div class="field">
                                <div class="name">
                                    <label for="phone">@lang('basket.phone'):</label>
                                </div>
                                <div class="input">
                                    <input type="text" name="phone">
                                </div>
                            </div>
                            <div class="field">
                                <div class="name">
                                    <label for="first-name">@lang('basket.name'):</label>
                                </div>
                                <div class="input">
                                    <input type="text" name="name">
                                </div>
                            </div>
                            <div class="field">
                                <div class="name">
                                    <label for="second-name">@lang('basket.second_name'):</label>
                                </div>
                                <div class="input">
                                    <input type="text" name="second_name">
                                </div>
                            </div>
                            <div class="field">
                                <div class="name">
                                    <label for="city">@lang('basket.city'):</label>
                                </div>
                                <div class="input">
                                    <input type="text" name="city">
                                </div>
                            </div>
                        </div>

                        <h3>@lang('basket.delivery_methods'):</h3>
                        <div class="delivery-methods">
                            @foreach($deliveryMethods as $deliveryMethod)
                                <label for="delivery_method_id_{{$deliveryMethod->id}}">
                                    <input type="radio" name="delivery_method_id" value="{{$deliveryMethod->id}}"
                                           id="delivery_method_id_{{$deliveryMethod->id}}">
                                    <div class="style-radio"></div>
                                    {{$deliveryMethod->deliveryMethodDescription->name}}
                                </label>
                            @endforeach
                        </div>
                        <h3>@lang('basket.payment_methods'):</h3>
                        <div class="payment-methods">
                            @foreach($paymentMethods as $paymentMethod)
                                <label for="payment_method_id_{{$paymentMethod->id}}">
                                    <input type="radio" name="payment_method_id" value="{{$paymentMethod->id}}"
                                           id="payment_method_id_{{$paymentMethod->id}}">
                                    <div class="style-radio"></div>
                                    {{$paymentMethod->paymentMethodDescription->name}}
                                </label>
                            @endforeach
                        </div>


                        <div class="comment">
                            <label for="comment">@lang('basket.comment'):</label>
                            <textarea name="comment" id="comment" cols="45" rows="3"></textarea>
                        </div>

                        <div class="btn-checkout">
                            <button>Sent</button>
                        </div>

                    </div>
                    {{--order data--}}
                </form>





            @else
                @lang('basket.no_products')
            @endif

        </div>

    </div>













@endsection

@section('page-scripts')
    <script src="/js/basket-page.js"></script>


@endsection
