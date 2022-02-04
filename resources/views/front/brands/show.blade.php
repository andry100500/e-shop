@extends('front.layout')
@section('meta_title') {{ $brand->brandDescription->meta_title }} @endsection
@section('meta_description') {{ $brand->brandDescription->meta_description }} @endsection
@section('meta_keywords') {{ $brand->brandDescription->meta_keywords }}  @endsection

@section('page-content')
    <div class="main-content container">
        <h1>{{ $brand->brandDescription->h1 }}</h1>


        <div class="products">
            @foreach($products as $product)
                @include('front.includes.product-card')
            @endforeach
        </div>

        <div class="paginator">
            <div class="show-more">
                <button><i class="fas fa-sync-alt"></i> @lang('common.showMore')</button>
            </div>

            {{ $products->links('front.includes.pagination') }}
        </div>

        @if($brand->brandDescription->description)
            <div class="description">
                {!! $brand->brandDescription->description !!}
            </div>
        @endif

    </div>

@endsection


