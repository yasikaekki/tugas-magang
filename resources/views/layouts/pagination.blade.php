@if ($paginator->hasPages())
    <ul class="pagination d-flex justify-content-between mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link ft16" aria-hidden="true">Sebelumnya</span>
            </li>
        @else
            <li class="page-item prev">
                <a class="page-link ft16" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Sebelumnya</a>
            </li>
        @endif

        <!-- batas -->

        <div class="d-flex">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item ft16 disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item ft16 active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item ft16"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        </div>

        <!-- batas -->

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item next">
                <a class="page-link ft16" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Selanjutnya</a>
            </li>
        @else
            <li class="page-item next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link ft16" aria-hidden="true">Selanjutnya</span>
            </li>
        @endif
    </ul>
@endif
