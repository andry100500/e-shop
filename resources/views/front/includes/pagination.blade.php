@if ($paginator->hasPages())
    <div class="paginator">
        <div class="show-more">
            <button class="show-more-produts"><i class="fas fa-sync-alt"></i> @lang('category.showMore')
            </button>
        </div>
        <div class="pagination">

            <ul>

                @if ($paginator->currentPage() === 1)
                    <li class="disabled">
                        <span>|<</span>
                    </li>
                @else
                    <li><a href="{{ request()->url() }}/">|<</a></li>
                @endif

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled">
                        <span aria-hidden="true">&lsaquo;</span>
                    </li>
                @elseif($paginator->currentPage() === 2)
                    <li><a href="{{ request()->url() }}/">&lsaquo;</a></li>
                @else
                    <li>
                        <a href="{{ \App\Http\Services\PaginateSlashManager::addSlash($paginator->previousPageUrl()) }}">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)

                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @php
                                $url = \App\Http\Services\PaginateSlashManager::addSlash($url);
                            @endphp
                            @if ($page == $paginator->currentPage())
                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                            @elseif ($page == 1)

                                <li><a href="{{ request()->url() }}/">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif

                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="next-page">
                        <a href="{{
                            \App\Http\Services\PaginateSlashManager::addSlash($paginator->nextPageUrl())
                         }}">&rsaquo;</a>
                    </li>
                @else
                    <li class="disabled">
                        <span>&rsaquo;</span>
                    </li>
                @endif


                @if ($paginator->currentPage() === $paginator->lastPage())
                    <li class="disabled">
                        <span>>|</span>
                    </li>
                @else
                    <li class="last-page"><a href="{{ request()->url() .'/?page=' . $paginator->lastPage()}}"> >|</a>
                    </li>
                @endif

            </ul>

            <p>
                @lang('category.showedFirst')
                {{ $paginator->firstItem() }}
                @lang('category.showedBy')123
                {{ $paginator->lastItem() }}
                @lang('category.showedFrom')
                {{ $paginator->total() }}
                @lang('category.showedAll')
                {{ $paginator->lastPage() }}
                @lang('category.showedLast')
            </p>


        </div>
    </div>
@endif
