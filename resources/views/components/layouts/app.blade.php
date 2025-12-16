<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Bookify Library' }}</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/png" href="{{ asset('book.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    @livewireStyles
</head>

<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen">

    {{-- NAVIGASI UTAMA --}}
    <nav x-data="{ isOpen: false }" class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-40 transition-all border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                {{-- 1. LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 cursor-pointer shrink-0">
                    <div class="bg-indigo-600 p-2 rounded-lg shadow-sm shadow-indigo-200">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-indigo-950 tracking-tight">Bookify<span class="text-indigo-600">Library</span></span>
                </a>

                {{-- 2. MENU TENGAH (Hanya Desktop) --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors duration-200">Beranda</a>
                    <a href="{{ route('home') }}#layanan" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors duration-200">Layanan</a>
                    <a href="{{ route('home') }}#katalog" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors duration-200">Katalog</a>
                    <a href="{{ route('home') }}#tentang" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors duration-200">Tentang</a>
                </div>

                {{-- 3. BAGIAN KANAN (Auth & Hamburger) --}}
                <div class="flex items-center gap-2 sm:gap-4">
                    @guest
                    {{-- Login/Register Desktop --}}
                    <div class="hidden md:flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-full hover:bg-indigo-700 transition text-sm font-medium shadow-lg shadow-indigo-200">Register</a>
                    </div>
                    @else
                    {{-- Notifikasi --}}
                    @if (auth()->user()->role === 'Anggota')
                    <div class="flex items-center">
                        <livewire:member.notification-user />
                    </div>
                    @endif

                    {{-- Profil Dropdown (Desktop) --}}
                    <div class="relative group hidden md:block">
                        <button class="flex items-center space-x-2 p-2 rounded-full hover:bg-slate-100 transition text-sm font-medium">
                            <div class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center border border-indigo-200">
                                <span class="text-indigo-700 font-bold text-xs">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="font-semibold text-slate-800">{{ auth()->user()->name }}</span>
                        </button>

                        <div class="absolute right-0 pt-2 w-56 z-50 hidden group-hover:block hover:block">
                            <div class="bg-white rounded-xl shadow-xl py-2 ring-1 ring-black ring-opacity-5 border border-slate-100">
                                <div class="px-4 py-3 border-b border-slate-100 mb-1">
                                    <p class="text-sm font-semibold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                @if (auth()->user()->role === 'Pustakawan')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                @else
                                <a href="{{ route('member.profile') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                                <a href="{{ route('member.loans.history') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Peminjaman Saya</a>
                                @endif
                                <hr class="my-1 border-slate-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endguest

                    {{-- Tombol Hamburger (Mobile) --}}
                    <div class="flex md:hidden ml-1">
                        <button @click="isOpen = !isOpen" type="button" class="text-slate-600 hover:text-indigo-600 focus:outline-none p-2 rounded-md hover:bg-slate-100 transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="isOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. MENU MOBILE --}}
        <div x-show="isOpen" x-cloak
            @click.away="isOpen = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden absolute top-16 left-0 w-full bg-white border-b border-slate-200 shadow-2xl z-50 flex flex-col max-h-[85vh] overflow-y-auto">

            {{-- 1. PROFIL USER (DITARUH PALING ATAS) --}}
            @auth
            <div class="bg-indigo-50/50 p-4 border-b border-indigo-100">
                <div class="flex items-center mb-4">
                    <div class="shrink-0">
                        <div class="h-12 w-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md border-2 border-white">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3 overflow-hidden">
                        <div class="text-base font-bold text-slate-800 truncate">{{ auth()->user()->name }}</div>
                        <div class="text-sm text-slate-500 truncate">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                {{-- Menu Khusus User --}}
                <div class="space-y-1 bg-white rounded-lg p-2 shadow-sm border border-slate-100">
                    @if (auth()->user()->role === 'Pustakawan')
                    <a href="{{ route('admin.dashboard') }}" @click="isOpen = false" class="flex items-center w-full px-3 py-2 text-sm font-medium text-slate-600 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('member.profile') }}" @click="isOpen = false" wire:navigate class="flex items-center w-full px-3 py-2 text-sm font-medium text-slate-600 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profil Saya
                    </a>
                    <a href="{{ route('member.loans.history') }}" @click="isOpen = false" wire:navigate class="flex items-center w-full px-3 py-2 text-sm font-medium text-slate-600 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Peminjaman Saya
                    </a>
                    @endif
                </div>
            </div>
            @endauth

            {{-- 2. MENU UTAMA/UMUM (Berada di Tengah) --}}
            <div class="px-4 py-4 space-y-1">
                <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Menu Utama</p>
                <a href="{{ route('home') }}" @click="isOpen = false" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 transition">Beranda</a>
                <a href="{{ route('home') }}#layanan" @click="isOpen = false" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 transition">Layanan</a>
                <a href="{{ route('home') }}#katalog" @click="isOpen = false" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 transition">Katalog</a>
                <a href="{{ route('home') }}#tentang" @click="isOpen = false" class="block px-4 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 transition">Tentang</a>
            </div>

            {{-- 3. LOGOUT / LOGIN (Paling Bawah) --}}
            <div class="px-4 pb-6 mt-auto">
                @auth
                <form method="POST" action="{{ route('logout') }}" class="pt-4 border-t border-slate-100">
                    @csrf
                    <button type="submit" class="flex items-center w-full justify-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Keluar Akun
                    </button>
                </form>
                @else
                <div class="grid grid-cols-2 gap-3 pt-2 border-t border-slate-100">
                    <a href="{{ route('login') }}" class="flex justify-center items-center px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 font-medium transition">Login</a>
                    <a href="{{ route('register') }}" class="flex justify-center items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium shadow-lg shadow-indigo-200 transition">Register</a>
                </div>
                @endauth
            </div>

        </div>
    </nav>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-slate-900 text-slate-400 py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            &copy; {{ date('Y') }} BookifyLibrary System. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>

</html>