@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')" style="position:relative;">
                    <span style="padding-left:30px;font-weight:bolder;letter-spacing:1px;" class="page-link" aria-hidden="true">
                        <i style="font-size:24px;position:absolute;left:0;padding-left:5px;" class="fas fa-long-arrow-alt-left"></i> PREVIOUS
                    </span>
                </li>
            @else
                <li class="page-item" style="position:relative;">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"
                        style="background-color:#F7AB07;color:#000000;padding-left:30px;font-weight:bolder;letter-spacing:1px;">
                        <i style="font-size:24px;position:absolute;left:0;padding-left:5px;" class="fas fa-long-arrow-alt-left"></i>PREVIOUS
                    </a>
                </li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link" 
                                style="background-color:#0E67B9;border:1px solid #0E67B9;font-weight:bolder;">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" 
                                style="font-weight:bolder;" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach 

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item" style="position:relative;">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"
                        style="background-color:#F7AB07;color:#000000;padding-right:30px;font-weight:bolder;letter-spacing:1px;">
                        NEXT <i style="font-size:24px;position:absolute;right:0;padding-right:5px;" class="fas fa-long-arrow-alt-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')" style="position:relative;">
                    <span class="page-link" aria-hidden="true" style="padding-right:30px;font-weight:bolder;letter-spacing:1px;">
                        NEXT <i style="font-size:24px;position:absolute;right:0;padding-right:5px;" class="fas fa-long-arrow-alt-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
