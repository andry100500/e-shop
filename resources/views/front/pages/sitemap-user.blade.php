@extends('front.layout')
@section('meta_title') @lang('sitemap.meta_title') @endsection
@section('meta_description') @lang('sitemap.meta_description')  @endsection
@section('meta_keywords') @lang('sitemap.meta_keywords')  @endsection

@section('page-content')
    <div class="main-content container sitemap-container">

        @include('front.includes.breadcrumbs')

        <h1>@lang('sitemap.h1') </h1>

        <div class="all-sitemap-links">

            <div class="categories">
                @foreach($categories as $category)
                    <div class="category">
                        <a href="{{ \App\Http\Services\LangLinkManager::current($category->url) }}">{{ $category->categoryDescription->name }}</a>
                    </div>
                    {{-- 1 --}}
                    @if(count($category->subCategories) > 0)
                        <div class="subcategories">
                            @foreach($category->subCategories as $subCategory)
                                <div class="subcategory">
                                    <a href="{{ \App\Http\Services\LangLinkManager::current($subCategory->url) }}">
                                        > {{ $subCategory->categoryDescription->name }}</a>

                                    {{-- 2 --}}
                                    @if(count($subCategory->subCategories) > 0)
                                        @foreach($subCategory->subCategories as $subCategory)
                                            <div class="subcategory">
                                                <a href="{{ \App\Http\Services\LangLinkManager::current($subCategory->url) }}">
                                                    >> {{ $subCategory->categoryDescription->name }}</a>

                                            </div>
                                        @endforeach
                                    @endif


                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>


            <div class="other-links">

                <div class="other">
                    <div>
                        <a href="{{ \App\Http\Services\LangLinkManager::current('/contact-us') }}">@lang('sitemap.contacts')</a>
                    </div>

                    <div>
                        <a href="{{ \App\Http\Services\LangLinkManager::current('/my-account/') }}">@lang('sitemap.cabinet')</a>
                    </div>

                    <div>
                        <a href="{{ \App\Http\Services\LangLinkManager::current('/wishlist/') }}">@lang('sitemap.bookmarks')</a>
                    </div>
                </div>


                <div class="pages">
                    <div class="block-name">
                        @lang('sitemap.info-pages-block-name')
                    </div>
                    @foreach($pages as $page)
                        <div class="page">

                            <a href="{{ \App\Http\Services\LangLinkManager::current($page->url) }}">{{ $page->pageDescription->name }}</a>
                        </div>
                    @endforeach
                </div>

                <div class="blog">
                    <div class="block-name">
                        <a href="{{ \App\Http\Services\LangLinkManager::current('/blog/') }}">@lang('sitemap.blog-block-name')</a>
                    </div>

                    @foreach($posts as $post)
                        <div class="post">

                            <a href="{{ \App\Http\Services\LangLinkManager::current($post->url) }}">{{ $post->postsDescription->name }}</a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection


