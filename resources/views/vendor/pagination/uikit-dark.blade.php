@if ($paginator->hasPages())
<div class="uk-article">
<div class="article uk-margin uk-background uk-box-shadow-small uk-border-rounded">
<div class="uk-container">
    <ul class="uk-pagination uk-flex-center" uk-margin>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="uk-disable">
                <a>
                    <span aria-label="@lang('pagination.previous')" uk-pagination-previous></span>
                </a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" aria-label="@lang('pagination.previous')">
                    <span uk-pagination-previous></span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="uk-disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="uk-active"><span class="uk-text-primary uk-text-bold">{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">
                    <span uk-pagination-next></span>
                </a>
            </li>
        @else
        <li class="ku-disable">
            <a aria-label="@lang('pagination.next')">
                <span uk-pagination-next></span>
            </a>
        </li>
        @endif
    </ul>
</div>
</div>
</div>
@endif
