<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <img src="{{ asset('AdminLTE/dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">Bookify</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('admin.loans') }}" class="nav-link {{ request()->routeIs('admin.loans') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Peminjaman</p>
                    </a>
                </li>
                <li class="nav-item">
                  <a wire:navigate href="{{ route('admin.returns') }}" class="nav-link {{ request()->routeIs('admin.returns') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Pengembalian</p>
                    </a>
                </li>

                </li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Data User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('admin.books') }}" class="nav-link {{ request()->routeIs('admin.books') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Data Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('admin.authors') }}" class="nav-link {{ request()->routeIs('admin.authors') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Data Penulis</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:navigate href="{{ route('admin.categories') }}" class="nav-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Data Kategori</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>