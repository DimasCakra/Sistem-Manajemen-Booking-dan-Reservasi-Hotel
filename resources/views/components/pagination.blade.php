{{-- Smart Pagination Component with Tailwind CSS --}}
@if ($paginator->hasPages())
    <div class="flex items-center justify-between mt-8 px-6 py-4 bg-white border-t border-gray-100">
        <div class="text-sm text-gray-600">
            Halaman <span class="font-semibold">{{ $paginator->currentPage() }}</span> dari 
            <span class="font-semibold">{{ $paginator->lastPage() }}</span> 
            (Total: <span class="font-semibold">{{ $paginator->total() }}</span> data)
        </div>

        <nav class="flex items-center gap-2">
            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="flex gap-1">
                @php
                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();
                    $window = 2; // pages to show around current page
                @endphp

                {{-- First Page --}}
                @if ($current > $window + 2)
                    <a href="{{ $paginator->url(1) }}" class="px-3 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition font-medium text-sm">
                        1
                    </a>
                    @if ($current > $window + 3)
                        <span class="px-2 py-2 text-gray-400">...</span>
                    @endif
                @endif

                {{-- Pages Around Current --}}
                @for ($i = max(1, $current - $window); $i <= min($last, $current + $window); $i++)
                    @if ($i == $current)
                        <span class="px-3 py-2 rounded-lg bg-red-500 text-white font-semibold text-sm">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $paginator->url($i) }}" class="px-3 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition font-medium text-sm">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                {{-- Last Page --}}
                @if ($current < $last - $window - 1)
                    @if ($current < $last - $window - 2)
                        <span class="px-2 py-2 text-gray-400">...</span>
                    @endif
                    <a href="{{ $paginator->url($last) }}" class="px-3 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition font-medium text-sm">
                        {{ $last }}
                    </a>
                @endif
            </div>

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @else
                <span class="px-3 py-2 rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            @endif
        </nav>
    </div>
@endif
