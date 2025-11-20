<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE v4 | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css">

    <style>
        /* --- CSS MANUAL: Agar Layout Rapi --- */

        /* 1. Saat Desktop (Layar Besar) & Sidebar Tutup */
        body.sidebar-collapse .app-main {
            margin-left: 0 !important;
            max-width: 100% !important;
        }

        /* 2. Saat Mobile (Layar Kecil) */
        @media (max-width: 991.98px) {
            .app-main {
                margin-left: 0 !important;
            }
        }

        /* Animasi geser halus */
        .app-main,
        .app-header {
            transition: margin-left 0.3s ease-in-out;
        }

        /* Header juga ikut geser saat tutup */
        body.sidebar-collapse .app-header {
            margin-left: 0 !important;
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
        // 1. Fungsi Toggle Sidebar (Dipanggil langsung dari onclick di header)
        window.toggleSidebar = function(event) {
            event.preventDefault(); // Mencegah link '#' loncat ke atas

            console.log("Tombol Bypass ditekan!"); // Cek console kalau penasaran

            if (window.innerWidth >= 992) {
                // Desktop: Toggle class collapse
                document.body.classList.toggle('sidebar-collapse');
            } else {
                // Mobile: Toggle class open
                document.body.classList.toggle('sidebar-open');
            }
        };

        // 2. Setup Scrollbar Sidebar (Biar bisa discroll rapi)
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
    </script>

    @livewireScripts
    @stack('scripts')
</body>

</html>