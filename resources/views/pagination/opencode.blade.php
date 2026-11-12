@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Pagination">

        {{-- info halaman --}}
        <span class="page-info">
            {{ $paginator->firstItem() }}&ndash;{{ $paginator->lastItem() }} / {{ $paginator->total() }}
        </span>

        {{-- prev --}}
        @if ($paginator->onFirstPage())
            <span class="page-btn disabled" aria-disabled="true">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-btn" rel="prev">&laquo;</a>
        @endif

        {{-- angka halaman --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" separator --}}
            @if (is_string($element))
                <span class="page-btn disabled">{{ $element }}</span>
            @endif

            {{-- link halaman --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-btn active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-btn" rel="next">&raquo;</a>
        @else
            <span class="page-btn disabled" aria-disabled="true">&raquo;</span>
        @endif

    </nav>
@endif
