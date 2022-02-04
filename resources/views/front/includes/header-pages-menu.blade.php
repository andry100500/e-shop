<div class="container">
    <div class="phone">
        <i class="fas fa-phone-alt icons"></i>
        <a href="">(093) 319-87-22</a>
        <i class="fas fa-angle-down caret"></i>
    </div>

    <div class="pages-menu">
        <div class="link"><a href="{{\App\Http\Services\LangLinkManager::current('/info/delivery-paiment')}}">@lang('common.deliveryPaymentAncor')</a></div>
        <div class="link"><a href="{{\App\Http\Services\LangLinkManager::current('/info/anonymity')}}">@lang('common.anonimityAncor')</a></div>
        <div class="link"><a href="{{\App\Http\Services\LangLinkManager::current('/blog')}}">@lang('common.blogAncor')</a></div>
        <div class="link"><a href="{{\App\Http\Services\LangLinkManager::current('/contact-us/')}}">@lang('common.contactsAncor')</a></div>
    </div>


    <div class="account">
        <i class="far fa-user icons"></i>
        <a href="{{\App\Http\Services\LangLinkManager::current('/login/')}}">@lang('common.comeInAncor')</a></div>


    <div class="language">
        @if(App::getLocale('ua') === 'ua')
            <a href="{{ \App\Http\Services\LangLinkManager::other()}}">RU</a> |
            <span>UA</span>
        @else
            <span>RU</span> | <a
                href="{{ \App\Http\Services\LangLinkManager::other()}}">UA</a>
        @endif
    </div>

</div>
