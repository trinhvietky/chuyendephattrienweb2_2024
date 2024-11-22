@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        <!-- Nút Previous -->
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true">
            <span class="page-link">Previous</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
        </li>
        @endif

        <!-- Hiển thị các trang liên tiếp -->
        @php
        // Giới hạn phạm vi trang hiện tại
        $startPage = max(1, $paginator->currentPage() - 1); // Trang đầu tiên hiển thị nếu ở trang thứ 2
        $endPage = min($startPage + 2, $paginator->lastPage()); // Giới hạn cuối cùng không vượt quá tổng số trang
        @endphp

        @for ($i = $startPage; $i <= $endPage; $i++)
            <li class="page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
            @endfor

            <!-- Nút Next -->
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">Next</span>
            </li>
            @endif
    </ul>

    </ul>


</nav>
@endif