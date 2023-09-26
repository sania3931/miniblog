@if ($paginator->hasPages())
<nav class="my-4" aria-label="...">

    <ul class="pagination pagination-circle justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">@lang('pagination.previous')</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="true">@lang('pagination.previous')</a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item disabled"><a class="page-link" href="{{ $url }}">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">@lang('pagination.next')</a>
            </li>
            @else
            <li class="page-item disabled">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" >@lang('pagination.next')</a>
            </li>
            @endif


            <!-- <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li> -->

    </ul>
</nav>
@endif
