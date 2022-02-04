@extends('front.layout')
@section('meta_title'){{ $category->categoryDescription->meta_title }}@endsection
@section('meta_description'){{ $category->categoryDescription->meta_description }}@endsection
@section('meta_keywords'){{ $category->categoryDescription->meta_keywords }}@endsection

@section('page-content')
    <div class="main-content container category-container">
        <div class="left-column">

            @lang('category.brag')

        </div>
        <div class="right-column">
            @include('front.includes.breadcrumbs')
            <h1 class="name-category">{{ $category->categoryDescription->h1 }}</h1>


            @if($category->firstChildCategories)

                <div class="sub-categories">
                    <div class="circle-categories">
                        <ul>
                            @foreach($category->firstChildCategories as $firstChildCategory)


                                {{--  nev--}}
                                <li>
                                    <div class="gray-circle">
                                        <a href="{{ \App\Http\Services\LangLinkManager::current($firstChildCategory->url) }}">
                                            <img
                                                src="{{ $firstChildCategory->image }}"
                                                alt="{{ $firstChildCategory->categoryDescription->name }}"></a>
                                    </div>
                                    <div class="name-circle-category">
                                        <a href="{{ \App\Http\Services\LangLinkManager::current($firstChildCategory->url) }}">{{ $firstChildCategory->categoryDescription->name }}</a>
                                    </div>
                                </li>
                                {{--  nev--}}
                            @endforeach




{{--                            <div class="category">--}}
{{--                                <div class="image">--}}
{{--                                    <a href="{{ \App\Http\Services\LangLinkManager::current($firstChildCategory->url) }}">--}}
{{--                                        <img src="{{ $firstChildCategory->image }}"--}}
{{--                                             alt="{{ $firstChildCategory->categoryDescription->name }}">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="name">--}}
{{--                                    <a href="{{ \App\Http\Services\LangLinkManager::current($firstChildCategory->url) }}">--}}
{{--                                        {{ $firstChildCategory->categoryDescription->name }}--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </ul>
                    </div>
                </div>

                {{--                <div class="child-categories">--}}
                {{--                    @foreach($category->firstChildCategories as $firstChildCategory)--}}
                {{--                        <div class="category">--}}
                {{--                            <div class="image">--}}
                {{--                                <a href="{{ \App\Http\Services\LangLinkManager::current($firstChildCategory->url) }}">--}}
                {{--                                    <img src="{{ $firstChildCategory->image }}"--}}
                {{--                                         alt="{{ $firstChildCategory->categoryDescription->name }}">--}}
                {{--                                </a>--}}
                {{--                            </div>--}}
                {{--                            <div class="name">--}}
                {{--                                <a href="{{ \App\Http\Services\LangLinkManager::current($firstChildCategory->url) }}">--}}
                {{--                                    {{ $firstChildCategory->categoryDescription->name }}--}}
                {{--                                </a>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}


                {{--                    @endforeach--}}
                {{--                </div>--}}
            @endif

            @if(count($products) > 2)
                <div class="sortirovka">
                    <button>@lang('category.sortButtonText') <i class="fas fa-angle-down"></i></button>
                </div>
            @endif
            <div class="products page-category">
                @foreach($products as $product)
                    @include('front.includes.product-card')
                @endforeach
            </div>


            {{ $products->links('front.includes.pagination') }}


            <div class="text-category">
                {!! $category->categoryDescription->description !!}
            </div>
        </div>
    </div>

@endsection

@section('page-scripts')
    <script src="/js/category.js"></script>
@endsection

