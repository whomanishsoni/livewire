@blaze

@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';

$disabledClasses = Flux::classes()
    ->add('relative inline-flex items-center px-3 py-2 text-sm font-medium cursor-default rounded-lg')
    ->add([
        'text-(--pagination-disabled-text) bg-(--pagination-disabled-background)',
        '[--pagination-disabled-text:var(--color-zinc-400)] dark:[--pagination-disabled-text:var(--color-zinc-500)]',
        '[--pagination-disabled-background:color-mix(in_oklab,var(--color-zinc-800),transparent_5%)] dark:[--pagination-disabled-background:color-mix(in_oklab,var(--color-white),transparent_10%)]',
    ]);

$buttonClasses = Flux::classes()
    ->add('relative inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg border transition-colors')
    ->add([
        'text-(--pagination-button-text) bg-(--pagination-button-background) border-(--pagination-button-border)',
        'hover:bg-(--pagination-button-hover-background) hover:border-(--pagination-button-hover-border)',
        '[--pagination-button-text:var(--color-zinc-700)] dark:[--pagination-button-text:var(--color-zinc-200)]',
        '[--pagination-button-background:var(--color-white)] dark:[--pagination-button-background:var(--color-zinc-700)]',
        '[--pagination-button-border:var(--color-zinc-200)] dark:[--pagination-button-border:var(--color-zinc-600)]',
        '[--pagination-button-hover-background:var(--color-zinc-50)] dark:[--pagination-button-hover-background:var(--color-zinc-600)]',
        '[--pagination-button-hover-border:var(--color-zinc-300)] dark:[--pagination-button-hover-border:var(--color-zinc-500)]',
    ]);

$currentClasses = Flux::classes()
    ->add('relative inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg border')
    ->add([
        'text-(--pagination-current-text) bg-(--pagination-current-background) border-(--pagination-current-border)',
        '[--pagination-current-text:var(--color-zinc-900)] dark:[--pagination-current-text:var(--color-white)]',
        '[--pagination-current-background:var(--color-zinc-100)] dark:[--pagination-current-background:var(--color-zinc-600)]',
        '[--pagination-current-border:var(--color-zinc-200)] dark:[--pagination-current-border:var(--color-zinc-500)]',
    ]);

$separatorClasses = Flux::classes()
    ->add('relative inline-flex items-center px-3 py-2 text-sm font-medium bg-transparent')
    ->add([
        'text-(--pagination-separator-text)',
        '[--pagination-separator-text:var(--color-zinc-400)] dark:[--pagination-separator-text:var(--color-zinc-500)]',
    ]);
@endphp

@if ($paginator->hasPages())
    <div class="flex justify-center">
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span {{ $disabledClasses }}>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </span>
            @else
                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" {{ $buttonClasses }}>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span {{ $separatorClasses }}>
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span {{ $currentClasses }}>
                                {{ $page }}
                            </span>
                        @else
                            <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" {{ $buttonClasses }}>
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" {{ $buttonClasses }}>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            @else
                <span {{ $disabledClasses }}>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            @endif
        </nav>
    </div>
@endif
