@if ($paginator->hasPages())
<nav class="d-flex justify-items-center justify-content-between">
    <div class="d-flex justify-content-between flex-fill d-sm-none">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.previous')</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                    rel="prev">@lang('pagination.previous')</a>
            </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.next')</span>
            </li>
            @endif
        </ul>
    </div>

    <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
        <div class="vs-pagination">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li class="disabled prev"><a href="javascript: void(0)" rel="prev"
                        aria-label="@lang('pagination.previous')" class="active">@lang('pagination.previous')</a></li>
                @else
                <li class="prev"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">@lang('pagination.previous')</a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><a href="javascript: void(0)" class="page-link">{{
                        $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                --}}
                <li class="page-item" aria-current="page"><a class="active disabled" href="javascript: void(0)">{{ $page
                        }}</a></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach
                @endif
                @endforeach


                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li class="page-item next"><a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">@lang('pagination.next')</a></li>
                @else
                <li class="page-item next"><a href="javascript: void(0)" rel="next"
                        aria-label="@lang('pagination.next')" class="active">@lang('pagination.next')</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@endif