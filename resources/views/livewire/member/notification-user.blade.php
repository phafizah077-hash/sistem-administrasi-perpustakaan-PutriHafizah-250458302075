<div class="relative" x-data="{ open: false }" @click.away="open = false"
    wire:poll.5s="refreshNotifications"> 
    <button @click="open = ! open" class="p-2 text-gray-500 hover:text-indigo-600 focus:outline-none relative transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a2 2 0 100 4m-2 0h-2" />
        </svg>

        @if ($notifications->count() > 0)
        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
            {{ $notifications->count() }}
        </span>
        @endif
    </button>

    <div x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10 border border-gray-100"
        style="display: none;">

        <div class="py-2 hide-scrollbar max-h-96 overflow-y-auto">
            <p class="px-4 py-2 text-sm font-semibold text-gray-700 border-b">
                Pemberitahuan Baru ({{ $notifications->count() }})
            </p>

            @forelse ($notifications as $notification)
            <a href="#" wire:click="dismiss('{{ $notification->id }}')" class="block hover:bg-gray-50 transition">
                <div class="flex items-start px-4 py-3">
                    <div class="flex-shrink-0 mr-3 mt-1">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-medium text-gray-900 leading-tight">
                            {{ $notification->message }}
                        </p>
                        <p class="text-xs text-indigo-600 mt-1">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </a>
            @empty
            <p class="px-4 py-3 text-sm text-gray-500 text-center">Tidak ada pemberitahuan baru.</p>
            @endforelse
        </div>

        @if ($notifications->count() > 0)
        <div class="border-t">
            <button wire:click="markAllAsRead" class="w-full text-center block px-4 py-2 text-sm text-indigo-600 hover:bg-gray-100 font-medium">
                Tandai Semua Sudah Dibaca
            </button>
        </div>
        @endif
    </div>
</div>