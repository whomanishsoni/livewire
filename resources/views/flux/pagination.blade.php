@props([
    'paginator' => null,
])

@if($paginator && $paginator->hasPages())
    <div class="flex justify-center">
        {!! $paginator->links('pagination::flux-pagination') !!}
    </div>
@endif
