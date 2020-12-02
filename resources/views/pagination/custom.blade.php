@if ($paginator->hasPages())
<div class="pro-pagination-style text-center mt-10">
    <ul>
        @if (!$paginator->onFirstPage())
        <li><a class="prev" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="icon-arrow-left"></i></a></li>
        @endif
        @foreach ($elements as $element)

            @if (is_array($element))
                 @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                       <li><a class="active" href="{{ $url }}">{{$page}}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{$page}}</a></li>
                    @endif
                 @endforeach
            @endif

        @endforeach
        @if ($paginator->hasMorePages())
            <li><a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next" ><i class="icon-arrow-right"></i></a></li>
        @endif
    </ul>
</div>
@endif
