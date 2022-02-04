@extends('front.layout')
@section('meta_title') {{ $post->postsDescription->meta_title }} @endsection
@section('meta_description') {{ $post->postsDescription->meta_description }} @endsection
@section('meta_keywords') {{ $post->postsDescription->meta_keywords }}  @endsection

@section('page-content')
    <div class=" container article-container">

        @include('front.includes.breadcrumbs')


        <h1>{{ $post->postsDescription->h1 }}</h1>
        <div>
            <img
                src="{{ $post->image }}"
                alt="{{ $post->postsDescription->h1 }}">
        </div>
        <div class="article-text">
            {!! $post->postsDescription->description !!}
        </div>
    </div>
@endsection


