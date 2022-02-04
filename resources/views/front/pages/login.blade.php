@extends('front.layout')
@section('meta_title') @lang('thank-you-page.meta_title') @endsection
@section('meta_description') @lang('thank-you-page.meta_description')  @endsection
@section('meta_keywords') @lang('thank-you-page.meta_keywords')  @endsection

@section('page-content')

    <div class="container login-register">
        @include('front.includes.breadcrumbs')
        <h1>@lang('login.h1')</h1>

        <div class="tabs">
            <input type="radio" id="login" name="tabs-group" checked>
            <label for="login">@lang('login.autorization')</label>
            <input type="radio" id="register" name="tabs-group">
            <label for="register">@lang('login.registration')</label>
            <section class="tab-content" id="login-content">
                <form action="">
                    <div class="fields">
                        <div class="field">
                            <div class="name">
                                <label for="e-mail">@lang('login.email')</label>
                            </div>
                            <div class="input">
                                <input type="text" name="e-mail">
                            </div>
                        </div>

                        <div class="field">
                            <div class="name">
                                <label for="password">@lang('login.password')</label>
                            </div>
                            <div class="input">
                                <input type="text" name="password">
                            </div>
                        </div>
                        <div class="forgot-password"><a href="">@lang('login.forgot_password')</a></div>
                    </div>
                    <div class="btn-login-register">
                        <button>@lang('login.to_come_in')</button>
                    </div>
                </form>

            </section>
            <section class="tab-content" id="register-content">
                <form action="">
                    <div class="fields">
                        <div class="field">
                            <div class="name">
                                <label for="e-mail">@lang('login.email')</label>
                            </div>
                            <div class="input">
                                <input type="text" name="e-mail">
                            </div>
                        </div>

                        <div class="field">
                            <div class="name">
                                <label for="password">@lang('login.password')</label>
                            </div>
                            <div class="input">
                                <input type="text" name="password">
                            </div>
                        </div>
                        <div class="field">
                            <div class="name">
                                <label for="repeat-password">@lang('login.repeat_password')</label>
                            </div>
                            <div class="input">
                                <input type="text" name="repeat-password">
                            </div>
                        </div>
                    </div>
                    <div class="btn-login-register">
                        <button>@lang('login.to_register')</button>
                    </div>
                </form>

            </section>
        </div>

    </div>

@endsection


















