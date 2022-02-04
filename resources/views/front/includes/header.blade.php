<div class="header">
    <div class="header-row-1">
        @include('front.includes.header-pages-menu')
    </div>
    <div class="header-row-2">
        <div class="container">
            <div class="logo">
                <div class="img-logo">
                    <i class="fas fa-circle circle"></i>
                    <i class="far fa-heart heart"></i>
                </div>
                <div class="text-logo">
                    <p class="text-malibu">
                        <a href="{{\App\Http\Services\LangLinkManager::current('/')}}">Malibu.com.ua</a>
                        <sup>18+</sup></p>
                    <p class="logo-losung">@lang('common.loogoDescriptor')</p>
                </div>
            </div>
            <div class="search">
                {{--                @include('front.includes.search')--}}
            </div>
            <div class="wishlist-widget"><i class="far fa-heart"></i>
{{--                <div class="products-count">0</div>--}}
            </div>

            <div class="basket-widget"><i class="fas fa-shopping-cart basket-widget"></i>
                <div class="products-count">0</div>
            </div>
        </div>


    </div>
    <div class="header-row-3">
        @include('front.includes.header-catalog-menu')
    </div>
    <div class="header-row-4">
        <div class="banner-string container">
            <p>@lang('common.underHeaderCatalogMenuBannerText')</p>
        </div>
    </div>
</div>
