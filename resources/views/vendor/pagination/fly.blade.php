@if ($paginator->hasPages())
    <div style="text-align: center;">
        <div class="laypage-main">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="laypage-prev"  disabled="disabled">上一页</a>
            @else
                <a class="laypage" href="{{ myPageUrl($paginator->previousPageUrl()) }}" rel="prev">上一页</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span>{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="laypage-curr">{{ $page }}</span>
                        @else
                            <a href="{{ myPageUrl($url) }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach


            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="laypage-next" href="{{ myPageUrl($paginator->nextPageUrl()) }}" rel="next">下一页</a>
            @else
                <a class="laypage-next" disabled="disabled">下一页</a>
            @endif
        </div>
    </div>
@endif