@extends('front.layout')
@section('meta_title') @lang('thank-you-page.meta_title') @endsection
@section('meta_description') @lang('thank-you-page.meta_description')  @endsection
@section('meta_keywords') @lang('thank-you-page.meta_keywords')  @endsection

@section('page-content')
    <div class="container thanks">
        @include('front.includes.breadcrumbs')
        <h1>@lang('thank-you-page.h1')</h1>
        <div class="image">
            <div class="heart"><i class="far fa-heart"></i></div>
            <div class="check"><i class="fas fa-check"></i></div>
        </div>
        <div class="text">
            @lang('thank-you-page.text')
        </div>
        <div class="buy-yet">
            <button>@lang('thank-you-page.continue_shopping')</button>
        </div>
    </div>


@endsection


















