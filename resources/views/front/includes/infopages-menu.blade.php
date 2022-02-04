{{--Шаблон меню, которое выводится в левом столбце на инфостраницах--}}

<div class="left-info-menu">
    <div class="h2">@lang('infopages-menu.information_text')</div>
    <div class="list-info-menu">
        <div><a href="{{\App\Http\Services\LangLinkManager::current('/info/anonymity')}}">@lang('infopages-menu.anonimity')</a></div>
        <div><a href="{{\App\Http\Services\LangLinkManager::current('/info/delivery-paiment')}}">@lang('infopages-menu.delivery_payment')</a></div>
        <div><a href="{{\App\Http\Services\LangLinkManager::current('/contact-us/')}}">@lang('infopages-menu.contacts')</a></div>
        <div><a href="{{\App\Http\Services\LangLinkManager::current('/info/terms')}}">@lang('infopages-menu.terms')</a></div>
        <div><a href="{{\App\Http\Services\LangLinkManager::current('/info/terms')}}">@lang('infopages-menu.terms')</a></div>
        <div><a href="{{\App\Http\Services\LangLinkManager::current('/blog')}}">@lang('infopages-menu.blog')</a></div>
    </div>
</div>
