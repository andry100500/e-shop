@extends('front.layout')
@section('meta_title') {{ $page->pageDescription->meta_title }} @endsection
@section('meta_description') {{ $page->pageDescription->meta_description }} @endsection
@section('meta_keywords') {{ $page->pageDescription->meta_keywords }}  @endsection

@section('page-content')
    <div class="main-content container">
        <div class="popular-categories container">
            <div class="h2">@lang('main_page.popular_rubrics')</div>
            <div class="circle-categories">
                <ul>

                    @foreach($catalogMenuLiks as $link)
                        <li>
                            <div class="gray-circle">
                                <a href="{{ $link->href }}"><img src="{{ $link->image }}" alt="{{ $link->menuItemDescription->name }}"></a>
                            </div>
                            <a href="{{ $link->href }}" class="name-circle-category">{{ $link->menuItemDescription->name }}</a>
                        </li>

                    @endforeach

                </ul>
            </div>
        </div>

    <h1>{{ $page->pageDescription->h1 }}</h1>
        <div class="description">{!! $page->pageDescription->description !!}</div>

        <div class="popular-products container">
            <h2>@lang('main_page.hits')</h2>
            @foreach($popularProducts as $product)
                @include('front.includes.product-card')
            @endforeach
        </div>
        <div class="aticles-announce container">
            <h2>@lang('main_page.articles')</h2>
            @foreach($latestPosts as $post)
                @include('front.includes.post-card')
            @endforeach
        </div>
    </div>
@endsection
