@if ($paginator->hasPages())
    <div class="pagination-container margin-top-30 margin-bottom-60">
        <nav class="pagination">
            <ul>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <!-- Hide the previous arrow when on the first page -->
                @else
                    <li class="pagination-arrow"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
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
                            @if ($page == $paginator->currentPage())
                                <li><a href="#" class="current-page">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="pagination-arrow"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                @else
                    <!-- Hide the next arrow when on the last page -->
                @endif
            </ul>
        </nav>
    </div>
@endif
