@extends('front.layout')
@section('meta_title') @lang('blog.meta_title') @endsection
@section('meta_description') @lang('blog.meta_description')  @endsection
@section('meta_keywords') @lang('blog.meta_keywords')  @endsection

@section('page-content')
    <div class="main-content container">
        @include('front.includes.breadcrumbs')
        <h1>@lang('blog.h1') </h1>

        <div class="articles">

            @foreach($posts as $post)
                <div class="article">
                    <div class="image">
                        <a href="{{\App\Http\Services\LangLinkManager::current($post->url)}}">
                            <img src="{{ $post->image }}" alt="{{ $post->postsDescription->name}} }}">
                        </a>
                    </div>
                    <div class="name">
                        <a href="{{\App\Http\Services\LangLinkManager::current($post->url)}}">{{$post->postsDescription->name}}</a>
                    </div>
                    <div class="preview">{!! $post->postsDescription->preview !!}
                        <a href="{{\App\Http\Services\LangLinkManager::current($post->url)}}">@lang('blog.reed_more')
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </div>

                </div>
            @endforeach

        </div>

    </div>

@endsection


