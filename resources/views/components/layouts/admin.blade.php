<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'Bookify Library' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('book.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .app-sidebar {
            background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%) !important;
            color: #e2e8f0 !important;
        }

        .sidebar-brand {
            background-color: rgba(0, 0, 0, 0.2) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu .nav-link {
            color: #cbd5e1 !important;
            margin-bottom: 4px;
            transition: all 0.3s ease;
        }

        .sidebar-menu .nav-link:hover {
            background-color: rgba(99, 102, 241, 0.2) !important;
            color: #ffffff !important;
            transform: translateX(5px);
        }

        .sidebar-menu .nav-link.active {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0.375rem;
        }

        .sidebar-menu .nav-icon {
            margin-right: 0.5rem;
        }

        body.sidebar-collapse .app-main,
        body.sidebar-collapse .app-header {
            margin-left: 0 !important;
            max-width: 100% !important;
        }

        @media (max-width: 991.98px) {
            .app-main {
                margin-left: 0 !important;
            }
        }

        .app-main,
        .app-header {
            transition: margin-left 0.3s ease-in-out;
        }

        .small-box {
            border-radius: 0.5rem;
            position: relative;
            display: block;
            margin-bottom: 1rem;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        }

        .small-box>.inner {
            padding: 10px;
        }

        .small-box h3 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            white-space: nowrap;
            padding: 0;
        }

        .small-box p {
            font-size: 1rem;
            margin: 0;
        }

        .small-box .small-box-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 40px;
            opacity: 0.3;
            width: 40px;
            height: 40px;
        }

        .chart-container {
            position: relative;
            height: 350px;
            width: 100%;
        }
    </style>

    @livewireStyles
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">
        @livewire('admin.partials.header')
        @livewire('admin.partials.sidebar')

        <main class="app-main">
            {{ $slot }}
        </main>

        @livewire('admin.partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/js/adminlte.min.js"></script>
    <script>
        window.toggleSidebar = function(event) {
            event.preventDefault();
            if (window.innerWidth >= 992) {
                document.body.classList.toggle('sidebar-collapse');
            } else {
                document.body.classList.toggle('sidebar-open');
            }
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(".sidebar-wrapper");
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined") {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: "os-theme-light",
                        autoHide: "leave",
                        clickScroll: true
                    },
                });
            }
        });

        document.addEventListener('livewire:navigated', () => {
            const dropdownElementList = document.querySelectorAll('[data-bs-toggle="dropdown"]');
            [...dropdownElementList].map(dropdownToggleEl => {
                const oldInstance = bootstrap.Dropdown.getInstance(dropdownToggleEl);
                if (oldInstance) oldInstance.dispose();
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>

    @livewireScripts
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>