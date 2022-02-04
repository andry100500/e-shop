@extends('front.layout')
@section('meta_title') @lang('wishlist.meta_title') @endsection
@section('meta_description') @lang('wishlist.meta_description')  @endsection
@section('meta_keywords') @lang('wishlist.meta_keywords')  @endsection

@section('page-content')
    <div class="main-content container">
        @include('front.includes.breadcrumbs')
        <h1>@lang('wishlist.h1') </h1>
                <style>
                    .products {
                        display: grid;
                        width: 100%;
                    }

                    .products .row {
                        display: flex;
                        padding: 10px;
                        border: 1px solid #cacaca;
                    }

                    .products .row .column {
                        padding: 0 10px;
                        border: 1px solid #cacaca;
                    }

                </style>

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
                @include('front.wishlist.wishlist-page-product-list')
            @else
                @lang('wishlist.no_products')
            @endif
        </div>

    </div>
@endsection


@section('page-scripts')
    <script src="/js/wishlist-page.js"></script>
@endsection
