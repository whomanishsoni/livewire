@props(['paginator'])

@if ($paginator->hasPages())
    <div class="flex items-center justify-center gap-1 mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <flux:button disabled variant="outline" size="sm" class="w-8 h-8 flex items-center justify-center">
                <flux:icon icon="chevron-left" class="w-3 h-3" />
            </flux:button>
        @else
            <flux:button wire:click="setPage({{ $paginator->currentPage() - 1 }})" variant="outline" size="sm" class="w-8 h-8 flex items-center justify-center">
                <flux:icon icon="chevron-left" class="w-3 h-3" />
            </flux:button>
        @endif

        {{-- Pagination Elements --}}
        @foreach (range(1, min(5, $paginator->lastPage())) as $page)
            @if ($page == $paginator->currentPage())
                <flux:button disabled variant="primary" size="sm" class="w-8 h-8 flex items-center justify-center">
                    {{ $page }}
                </flux:button>
            @else
                <flux:button wire:click="setPage({{ $page }})" variant="outline" size="sm" class="w-8 h-8 flex items-center justify-center">
                    {{ $page }}
                </flux:button>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <flux:button wire:click="setPage({{ $paginator->currentPage() + 1 }})" variant="outline" size="sm" class="w-8 h-8 flex items-center justify-center">
                <flux:icon icon="chevron-right" class="w-3 h-3" />
            </flux:button>
        @else
            <flux:button disabled variant="outline" size="sm" class="w-8 h-8 flex items-center justify-center">
                <flux:icon icon="chevron-right" class="w-3 h-3" />
            </flux:button>
        @endif
    </div>
@endif
