<div style="margin: 0 auto; padding-top: 10px; padding-bottom: 10px;">
    @if ($paginator->lastPage() > 1)
    <ul class="pagination paginate_bar">
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }} page-item">
            <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-1) }}">Previous</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }} page-item">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} page-item">
            <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}" >Next</a>
        </li>
    </ul>
    @endif
</div>
