<div class="mt-3">
    <!--Pagination start -->
    @if ($data->hasPages())
    <nav aria-label="Page navigation example ">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($data->onFirstPage())
            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev">Previous</a></li>
            @endif

            @if($data->currentPage() > 3)
            <li class="hidden-xs page-item"><a class="page-link" href="{{ $data->url(1) }}">1</a></li>
            @endif

            @if($data->currentPage() > 4)
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            @endif

            @foreach(range(1, $data->lastPage()) as $i)
            @if($i >= $data->currentPage() - 2 && $i <= $data->currentPage() + 2)
                @if ($i == $data->currentPage())
                <li class="page-item active"><span class="btn">{{ $i }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a></li>
                @endif
                @endif
                @endforeach

                @if($data->currentPage() < $data->lastPage() - 3)
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    @endif

                    @if($data->currentPage() < $data->lastPage() - 2)
                        <li class="hidden-xs page-item"><a class="page-link" href="{{ $data->url($data->lastPage()) }}">{{ $data->lastPage() }}</a></li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($data->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next">»</a></li>
                        @else
                        <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                        @endif
        </ul>
    </nav>
    @endif
    <!--End Pagination -->
</div>