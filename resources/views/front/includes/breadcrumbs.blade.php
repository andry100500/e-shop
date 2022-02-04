@php
    $breadcrumbsCount = count($breadcrumbs);
@endphp

@if($breadcrumbsCount >= 1)
    <div class="bread-crumbs container">
        <ul>
            <li><a href="{{\App\Http\Services\LangLinkManager::current('/')}}" title="Сексшоп Malibu" class="bread-crumbs-home"><i
                        class="fas fa-home"></i></a> /
            </li>

            @foreach($breadcrumbs as $key => $breadcrumb)
                @if($key === $breadcrumbsCount - 1)
                    <li>{{$breadcrumb['ancor']}}</li>
                @else
                    <li>
                        <a href="{{ \App\Http\Services\LangLinkManager::current($breadcrumb['url']) }}">{{$breadcrumb['ancor']}}</a>
                        /
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
