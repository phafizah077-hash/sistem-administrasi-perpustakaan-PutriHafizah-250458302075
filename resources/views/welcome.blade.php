<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PerpusKita - Sistem Perpustakaan</title>

    <!-- Menggunakan Tailwind CSS via CDN agar langsung tampil cantik tanpa npm run dev -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
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

<body class="bg-slate-50 text-slate-900">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2 cursor-pointer">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-indigo-900 tracking-tight">Perpus<span class="text-indigo-600">Kita</span></span>
                </a>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('home') }}#katalog" wire:navigate class="text-slate-600 hover:text-indigo-600 font-medium transition">Katalog</a>
                    @guest
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition text-sm font-medium">
                        Register
                    </a>
                    @else
                    <div class="relative group">
                        <button class="flex items-center space-x-2 bg-slate-900 text-white px-4 py-2 rounded-full hover:bg-slate-800 transition text-sm font-medium">
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block">
                            @if (auth()->user()->role === 'Pustakawan')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                            @elseif (auth()->user()->role === 'Anggota')
                            <a href="{{ route('member.loans.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Riwayat Peminjaman</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="bg-gradient-to-br from-indigo-900 to-slate-900 text-white py-20 px-4 sm:px-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 opacity-10 pointer-events-none">
            <svg class="w-96 h-96 transform translate-x-20 -translate-y-20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6">
                Jelajahi Dunia Lewat <span class="text-indigo-400">Buku</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-2xl mx-auto mb-10">
                Sistem administrasi perpustakaan modern. Temukan ribuan koleksi buku dengan mudah dan cepat.
            </p>
            <a href="#katalog" class="bg-indigo-500 hover:bg-indigo-600 text-white px-8 py-3 rounded-full font-semibold transition shadow-lg shadow-indigo-500/30 inline-block">
                Cari Buku Sekarang
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main id="katalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-slate-900">Katalog Perpustakaan</h2>
            <p class="text-slate-500 mt-2">Gunakan fitur pencarian dan filter di bawah ini</p>
        </div>

        @livewire('public.book-search')

    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-slate-400 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            &copy; {{ date('Y') }} PerpusKita System. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>

</html>