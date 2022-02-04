@extends('front.layout')
@section('meta_title') @lang('brands.meta_title') @endsection
@section('meta_description') @lang('brands.meta_description')  @endsection
@section('meta_keywords') @lang('brands.meta_keywords')  @endsection

@section('page-content')
    <div class="main-content container">
        <h1>@lang('brands.h1') </h1>

        <div class="navigation">
            @foreach($brands as $letter => $letterBrands)
                <div class="letter">
                    <a href="#{{ $letter }}">{{ $letter }}</a>
                </div>
            @endforeach
        </div>

        <div class="brands-list">
            @foreach($brands as $letter => $letterBrands)
                <div class="letter">
                    <h2 class="letter-header" id="{{$letter}}">
                        {{ $letter }}
                    </h2>
                    <div class="letter-brands">
                        @foreach($letterBrands as $brand)
                            <div class="brand">
                                <a href="{{ \App\Http\Services\LangLinkManager::current($brand['url']) }}">{{ $brand['name']}}</a>
                            </div>
                        @endforeach


                    </div>
                </div>
            @endforeach

        </div>

    </div>

@endsection


