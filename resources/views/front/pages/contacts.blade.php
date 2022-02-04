@extends('front.layout')
@section('meta_title') @lang('contacts.meta_title') @endsection
@section('meta_description') @lang('contacts.meta_description')  @endsection
@section('meta_keywords') @lang('contacts.meta_keywords')  @endsection

@section('page-content')

    <div class="container contacts">
        @include('front.includes.breadcrumbs')

        @include('front.includes.infopages-menu')

        <div class="main-info">
            <h1>@lang('contacts.h1')</h1>
            <div class="info">
                <div class="text">
                    <div class="block">
                        <p class="name">@lang('contacts.shop_name')</p>
                        <p>@lang('contacts.adress')</p>
                    </div>

                    <div class="block">
                        <p>(093) 319-87-22</p>
                        <p>E-mail: <a href="mailto:mail@malibu.com.ua">mail@malibu.com.ua</a></p>
                    </div>

                    <div class="block"><p>@lang('contacts.schedule')</p></div>

                    <div class="block">
                        <p>@lang('contacts.contact_page_description')</p>
                    </div>
                </div>
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2537.9484652382807!2d30.424621515849246!3d50.497916891824445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cd73fb0b6dd9%3A0x99ede04919247900!2z0YPQuy4g0KHQtdGA0LNl0Y8g0JTQsNC90YfQtdC90LrQviwgMywg0JrQuNC10LIsIDAyMDAw!5e0!3m2!1sru!2sua!4v1585416879132!5m2!1sru!2sua"
                            width="600" height="400" frameborder=""></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection



