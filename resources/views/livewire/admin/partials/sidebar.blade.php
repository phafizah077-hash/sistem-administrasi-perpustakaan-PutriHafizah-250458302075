<aside class="app-sidebar shadow" data-bs-theme="dark">
    <div class="sidebar-brand d-flex justify-content-center align-items-center">
        <a href="{{ route('admin.dashboard') }}" class="brand-link text-decoration-none d-flex align-items-center gap-2">
            <div class="d-flex align-items-center justify-content-center rounded shadow-sm"
                style="width: 32px; height: 32px; background-color: #4f46e5;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: white; width: 20px; height: 20px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>

            <span class="brand-text fw-bold text-white" style="font-size: 1.1rem; letter-spacing: 0.5px;">
                Bookify<span style="color: #818cf8;">Library</span>
            </span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-3">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation">
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-grid-1x2-fill"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase text-secondary fw-bold mt-2" style="font-size: 0.75rem; letter-spacing: 1px;">Transaksi</li>

                <li class="nav-item">
                    {{-- PERBAIKAN: Menambahkan '*' agar aktif di halaman create/edit --}}
                    <a wire:navigate href="{{ route('admin.loans') }}" class="nav-link {{ request()->routeIs('admin.loans*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-basket2-fill"></i>
                        <p>Peminjaman</p>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    {{-- PERBAIKAN: Menambahkan '*' --}}
                    <a wire:navigate href="{{ route('admin.returns') }}" class="nav-link {{ request()->routeIs('admin.returns*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-arrow-counterclockwise"></i>
                        <p>Pengembalian</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase text-secondary fw-bold mt-2" style="font-size: 0.75rem; letter-spacing: 1px;">Master Data</li>

                <li class="nav-item">
                    {{-- PERBAIKAN: Menambahkan '*' --}}
                    <a wire:navigate href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Data User</p>
                    </a>
                </li>

                <li class="nav-item">
                    {{-- PERBAIKAN: Menambahkan '*' --}}
                    <a wire:navigate href="{{ route('admin.books') }}" class="nav-link {{ request()->routeIs('admin.books*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-book-half"></i>
                        <p>Data Buku</p>
                    </a>
                </li>

                <li class="nav-item">
                    {{-- PERBAIKAN: Menambahkan '*' --}}
                    <a wire:navigate href="{{ route('admin.authors') }}" class="nav-link {{ request()->routeIs('admin.authors*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-pen-fill"></i>
                        <p>Data Penulis</p>
                    </a>
                </li>

                <li class="nav-item">
                    {{-- PERBAIKAN: Menambahkan '*' --}}
                    <a wire:navigate href="{{ route('admin.categories') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-tags-fill"></i>
                        <p>Data Kategori</p>
                    </a>
                </li>

            </ul>

            <ul class="nav sidebar-menu flex-column border-top border-secondary-subtle mt-4 pt-3" role="navigation">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <a href="#" class="nav-link text-danger"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>Logout</p>
                        </a>
                    </form>
                </li>
            </ul>

        </nav>
    </div>
</aside>