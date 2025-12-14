<nav class="app-header navbar navbar-expand bg-white shadow-sm border-bottom-0" style="height: 70px;">

    <style>
        .hover-text-indigo {
            transition: color 0.2s;
        }

        .hover-text-indigo:hover {
            color: #4f46e5 !important;
        }

        .hover-bg-indigo-50 {
            transition: background-color 0.2s;
        }

        .hover-bg-indigo-50:hover {
            background-color: #eef2ff;
        }

        .user-menu .dropdown-toggle::after {
            display: none;
        }

        .bg-indigo-50 {
            background-color: #eef2ff;
        }

        .text-indigo-600 {
            color: #4f46e5;
        }
    </style>

    <div class="container-fluid">
        <ul class="navbar-nav flex-row align-items-center gap-3">
            <li class="nav-item">
                <a class="nav-link p-2 rounded-circle hover-bg-indigo-50 d-flex align-items-center justify-content-center"
                    href="#"
                    role="button"
                    onclick="toggleSidebar(event)"
                    style="width: 40px; height: 40px; color: #4f46e5;">
                    <i class="bi bi-list fs-4"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('home') }}" class="nav-link fw-bold text-secondary hover-text-indigo">
                    Beranda
                </a>
            </li>
        </ul>
        <ul class="navbar-nav flex-row ms-auto align-items-center">
            <li class="nav-item">
                <div class="nav-link d-flex align-items-center gap-2 p-0">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-indigo-50 text-indigo-600 shadow-sm border border-indigo-100"
                        style="width: 35px; height: 35px;">
                        <i class="bi bi-person-fill fs-5"></i>
                    </div>
                    <span class="d-none d-md-inline fw-bold text-dark" style="font-size: 0.9rem;">
                        {{ Auth::user()->name }}
                    </span>
                </div>
            </li>
        </ul>

    </div>
</nav>