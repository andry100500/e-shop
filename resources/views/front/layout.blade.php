<!doctype html>
<html lang="{{ \Illuminate\Support\Facades\App::getLocale()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('meta_title')</title>
    <meta name="description" content="@yield('meta_description')"/>
    <meta name="keywords" content="@yield('meta_keywords')"/>

    @foreach(\App\Http\Services\LangLinkManager::getRellAlternateLinks() as $lang => $link)
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $link }}"/>
    @endforeach

    <link rel="stylesheet" type="text/css" href="/css/common.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
          integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">


    <link href="/image/catalog/design/favicon.png" rel="icon">

</head>

<body id="top">


@include('front.includes.header')
@yield('page-content')
@include('front.includes.footer')


<div class="arrow-up">
    <a href="#top"><i class="fas fa-arrow-circle-up"></i></a>
</div>


<script type="module" src="/js/common.js"></script>

@hasSection('page-scripts')
    @yield('page-scripts')
@endif

</body>
</html>
