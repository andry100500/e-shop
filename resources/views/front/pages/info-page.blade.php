@extends('front.layout')
@section('meta_title') {{ $page->pageDescription->meta_title }} @endsection
@section('meta_description') {{ $page->pageDescription->meta_description }} @endsection
@section('meta_keywords') {{ $page->pageDescription->meta_keywords }}  @endsection

@section('page-content')
    <div class="container">

        @include('front.includes.infopages-menu')

        <div class="main-info">
            @include('front.includes.breadcrumbs')
            <h1>{{ $page->pageDescription->h1 }}</h1>
            <div class="info-text">
                {!! $page->pageDescription->description !!}
            </div>
        </div>
    </div>
@endsection




