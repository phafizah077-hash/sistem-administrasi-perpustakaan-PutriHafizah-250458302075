 <div>
     <style>
         /* Mengatur posisi dan warna ikon agar terlihat jelas */
         .small-box {
             position: relative;
             overflow: hidden;
             /* Agar ikon yang besar tidak keluar kotak */
         }

         .small-box .small-box-icon {
             position: absolute;
             top: 10px;
             /* Jarak dari atas */
             right: 10px;
             /* Jarak dari kanan */
             z-index: 0;
             font-size: 60px;
             /* Ukuran ikon, sesuaikan jika perlu */

             /* INI KUNCINYA: Ubah warna jadi putih transparan */
             color: rgba(255, 255, 255, 0.4) !important;

             transition: transform .3s linear;
         }

         /* Efek saat mouse diarahkan (opsional, biar keren) */
         .small-box:hover .small-box-icon {
             transform: scale(1.1);
             color: rgba(255, 255, 255, 0.6) !important;
         }

         /* Memastikan teks tetap di atas ikon */
         .small-box .inner {
             position: relative;
             z-index: 1;
             color: #fff;
             /* Pastikan teks putih */
         }
     </style>

     <div class="app-content-header bg-white shadow-sm py-3 mb-4">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-sm-12">
                     <h3 class="mb-0">Pustakawan Dashboard</h3>
                 </div>
             </div>
         </div>
     </div>

     <div class="app-content">
         <div class="container-fluid">
             <div class="row row-deck row-cards">
                 <div class="row mb-4">
                     <div class="col-lg-3 col-6">
                         <div class="small-box text-bg-primary">
                             <div class="inner">
                                 <h3>{{ $userCount }}</h3>
                                 <p>Jumlah Anggota</p>
                             </div>
                             <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                             </svg>
                         </div>
                     </div>
                     <div class="col-lg-3 col-6">
                         <div class="small-box text-bg-success">
                             <div class="inner">
                                 <h3>{{ $authorCount }}</h3>
                                 <p>Jumlah Penulis</p>
                             </div>
                             <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                 <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                 <path d="M16 5l3 3" />
                             </svg>
                         </div>
                     </div>
                     <div class="col-lg-3 col-6">
                         <div class="small-box text-bg-secondary">
                             <div class="inner">
                                 <h3>{{ $categoryCount }}</h3>
                                 <p>Jumlah Kategori</p>
                             </div>
                             <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M4 4h6v6h-6z" />
                                 <path d="M14 4h6v6h-6z" />
                                 <path d="M4 14h6v6h-6z" />
                                 <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                             </svg>
                         </div>
                     </div>
                 </div>

                 <div class="row">
                     <div class="col-lg-8">
                         <div class="card shadow-sm mb-4">
                             <div class="card-header border-0">
                                 <h3 class="card-title">Tren Peminjaman & Pengembalian Buku</h3>
                             </div>
                             <div class="card-body">
                                 <div class="chart-container">
                                     <canvas id="barChart"></canvas>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-4">
                         <div class="card shadow-sm mb-4">
                             <div class="card-header border-0">
                                 <h3 class="card-title">Status Ketersediaan Buku</h3>
                             </div>
                             <div class="card-body d-flex justify-content-center align-items-center">
                                 <div class="chart-container" style="max-height: 300px; max-width: 300px;">
                                     <canvas id="doughnutChart"></canvas>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     @push('scripts')
     <script>
         const colorPrimary = '#0d6efd';
         const colorSuccess = '#198754';
         const colorWarning = '#ffc107';
         const colorDanger = '#dc3545';
         const ctxBar = document.getElementById('barChart');
         new Chart(ctxBar, {
             type: 'bar',
             data: {
                 labels: @json($monthlyLoans['labels']),
                 datasets: [{
                         label: 'Peminjaman',
                         data: @json($monthlyLoans['data']),
                         backgroundColor: colorPrimary,
                         borderColor: colorPrimary,
                         borderWidth: 1
                     },
                     {
                         label: 'Pengembalian',
                         data: @json($monthlyReturns['data']),
                         backgroundColor: colorSuccess,
                         borderColor: colorSuccess,
                         borderWidth: 1
                     }
                 ]
             },
             options: {
                 responsive: true,
                 maintainAspectRatio: false,
                 plugins: {
                     legend: {
                         position: 'bottom',
                     },
                     title: {
                         display: false,
                     }
                 },
                 scales: {
                     y: {
                         beginAtZero: true,
                         grid: {
                             color: 'rgba(0, 0, 0, 0.05)'
                         }
                     },
                     x: {
                         grid: {
                             display: false
                         }
                     }
                 }
             }
         });

         const ctxDoughnut = document.getElementById('doughnutChart');
         new Chart(ctxDoughnut, {
             type: 'doughnut',
             data: {
                 labels: ['Tersedia', 'Dipinjam'],
                 datasets: [{
                     label: 'Total Buku',
                     data: [@json($bookStatus['available']), @json($bookStatus['borrowed']), @json($bookStatus['lost_damaged'])],
                     backgroundColor: [
                         colorSuccess,
                         colorPrimary,
                         colorDanger,
                     ],
                     hoverOffset: 8,
                     borderWidth: 2,
                     borderColor: '#ffffff',
                 }]
             },
             options: {
                 responsive: true,
                 maintainAspectRatio: false,
                 plugins: {
                     legend: {
                         position: 'bottom',
                     },
                     title: {
                         display: false,
                     }
                 }
             }
         });
     </script>
     @endpush
 </div>