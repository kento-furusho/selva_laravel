{{-- @if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- First Page Link --}}
            <!-- 最初のページへのリンク -->

        {{-- Previous Page Link --}}
@if(!$paginator->onFirstPage())
    <li class="page-item">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">&lt;<span>前へ</span></a>
    </li>
    @endif

        {{-- Pagination Elemnts --}}
    {{-- Array Of Links --}}
    {{-- 定数よりもページ数が多い時 --}}
    @if ($paginator->lastPage() > 3)

    {{-- 現在ページが表示するリンクの中心位置よりも左の時 --}}
    @if ($paginator->currentPage() <= floor(3 / 2))
        <?php $start_page = 1; //最初のページ ?>
        <?php $end_page = 3; ?>

    {{-- 現在ページが表示するリンクの中心位置よりも右の時 --}}
    @elseif ($paginator->currentPage() > $paginator->lastPage() - floor(3 / 2))
        <?php $start_page = $paginator->lastPage() - (3 - 1); ?>
        <?php $end_page = $paginator->lastPage(); ?>

    {{-- 現在ページが表示するリンクの中心位置の時 --}}
    @else
        <?php $start_page = $paginator->currentPage() - (floor((3 % 2 == 0 ? 3 - 1 : 3)  / 2)); ?>
        <?php $end_page = $paginator->currentPage() + floor(3 / 2); ?>
    @endif

    {{-- 定数よりもページ数が少ない時 --}}
    @else
        <?php $start_page = 1; ?>
        <?php $end_page = $paginator->lastPage(); ?>
    @endif

    {{-- 処理部分 --}}
    @for ($i = $start_page; $i <= $end_page; $i++)
        @if ($i == $paginator->currentPage())
            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endif
    @endfor
    {{-- Next Page Link --}}
    @if($paginator->currentPage() !== $paginator->lastPage())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><span>次へ&gt;</span></a>
        </li>
    @endif

    </ul>
@endif
