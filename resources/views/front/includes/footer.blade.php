<div class="footer">
    <div class="container cont-footer">
        <div class="footer-row-1">
            <div class="information">
                <div class="footer-block-name">
                    <i class="far fa-file-alt"></i>
                    <p>@lang('common.info')</p>
                </div>
                <ul>
{{--                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/info/about')}}">@lang('common.aboutAncor')</a></li>--}}
                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/info/vacancies')}}">@lang('common.vacanciesAncor')</a></li>
                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/contact-us/')}}">@lang('common.contactsAncor')</a></li>
                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/info/anonymity')}}">@lang('common.anonimityAncor')</a></li>
                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/info/delivery-paiment')}}">@lang('common.deliveryPaymentAncor')</a></li>

{{--                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/info/add-return/')}}">@lang('common.returnAncor')</a></li>--}}
                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/info/terms')}}">@lang('common.termsAncor')</a></li>
                </ul>
            </div>
            <div class="contacts">
                <div class="footer-block-name">
                    <i class="fas fa-mobile-alt"></i>
                    <p>@lang('common.contacts')</p>
                </div>
                <ul>
                    <li>@lang('common.phone'): (093) 319-87-22</li>
                    <li>@lang('common.workingTime'): Пн-Вс 9:00 - 20:00</li>
                    <li>@lang('common.adressText')</li>
                    <li><a href="mailto:mail@malibu.com.ua">E-mail: mail@malibu.com.ua</a></li>
                </ul>
            </div>
            <div class="dop-info">
                <div class="footer-block-name">
                    <i class="far fa-folder"></i>
                    <p>@lang('common.additional')</p>
                </div>
                <ul>
                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/brands/')}}">@lang('common.brandsAncor')</a></li>
                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/sitemap/')}}">@lang('common.sitemapAncor')</a></li>
                </ul>
            </div>
            <div class="personal-account">
                <div class="footer-block-name">
                    <i class="far fa-user"></i>
                    <p>@lang('common.cabinet')</p>
                </div>
                <ul>
                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/my-account/')}}">@lang('common.cabinetAncor')</a></li>
                    <li><a href="{{\App\Http\Services\LangLinkManager::current('/wishlist/')}}">@lang('common.bookmarksAncor')</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-row-2">
            <div class="attention">
                <div class="footer-block-name">
                    <i class="far fa-hand-paper"></i>
                    <p>@lang('common.attention')</p>
                </div>
                <p>@lang('common.eighteenPlusText')</p>
            </div>
            <div class="stay-connection">
                <div class="footer-block-name">
                    <i class="far fa-envelope-open"></i>
                    <p>@lang('common.stayOnTouch')</p>
                </div>
                <p>@lang('common.CTAsubscriptionToNewsletter')</p>
                <input type="text" name="email" placeholder="E-mail">
                <button class="subscribe"><i class="fas fa-angle-right"></i></button>
            </div>
            <div class="dont-copy">
                <p>@lang('common.copyright')</p>
            </div>
        </div>
    </div>
</div>
