@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin | SAP ADHI')

@section('content')
    <!-- Login Success Notification -->
    @if (session('login_success'))
        <div class="position-fixed" style="top: 70px; right: 20px; z-index: 1050;">
            <div id="loginSuccessToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000" style="background-color: #089700;">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-check-circle-fill me-2"></i> Login berhasil! Selamat datang Admin.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 id="greetingMessage" class="h4"></h2>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-2">
        <!-- Card 1: Jumlah Jasa Konstruksi -->
        <div class="col-xl col-md">
            <a href="{{ route('jasa-konstruksi.index') }}" class="text-decoration-none">
                <div class="card border-left-primary card-custom shadow h-100 py-2 card-primary">
                    <div class="card-body card-body-custom">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Jumlah Jasa Konstruksi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jasaKonstruksiCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-building card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 2: Jumlah Manufacturing -->
        <div class="col-xl col-md">
            <a href="{{ route('manufacturing.index') }}" class="text-decoration-none">
                <div class="card border-left-success card-custom shadow h-100 py-2 card-success">
                    <div class="card-body card-body-custom">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Jumlah Manufacturing
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $manufacturingCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-gear card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 3: Jumlah Jasa Non Konstruksi -->
        <div class="col-xl col-md">
            <a href="{{ route('jasa-non-konstruksi.index') }}" class="text-decoration-none">
                <div class="card border-left-info card-custom shadow h-100 py-2 card-info">
                    <div class="card-body card-body-custom">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Jumlah Jasa Non Konstruksi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jasaNonKonstruksiCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-tools card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 4: Jumlah Capex Procurement -->
        <div class="col-xl col-md">
            <a href="{{ route('capex-procurement.index') }}" class="text-decoration-none">
                <div class="card border-left-danger card-custom shadow h-100 py-2 card-danger">
                    <div class="card-body card-body-custom">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Jumlah Capex Procurement
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $capexProcurementCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cart card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 5: Jumlah Internal Project -->
        <div class="col-xl col-md">
            <a href="{{ route('internal-project.index') }}" class="text-decoration-none">
                <div class="card border-left-warning card-custom shadow h-100 py-2 card-warning">
                    <div class="card-body card-body-custom">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Jumlah Internal Project
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $internalProjectCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-briefcase card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Aktivitas Terbaru -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Aktivitas
                        @if($newActivityCount > 0)
                            <span class="badge bg-danger">{{ $newActivityCount }}</span>
                        @endif
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-group text-start">
                        @foreach($recentActivities as $activity)
                            <li class="list-group-item">
                                <div>
                                    <strong>Pesan:</strong> {{ $activity->activity }}
                                    @if ($activity->created_at >= \Carbon\Carbon::now()->subDay())
                                        <span class="badge bg-danger">BARU</span>
                                    @endif
                                </div>
                                <!-- Menjadi: -->
                                <span class="activity-time text-muted">
                                    @php
                                        $time = $activity->created_at;
                                        $now = \Carbon\Carbon::now();
                                        $diff = $time->diffInSeconds($now);
                                        
                                        if ($diff < 60) {
                                            echo "Baru saja";
                                        } elseif ($diff < 3600) {
                                            echo floor($diff / 60) . " menit yang lalu";
                                        } elseif ($diff < 86400) {
                                            echo floor($diff / 3600) . " jam yang lalu";
                                        } elseif ($diff < 604800) { /* 7 hari atau 1 minggu */
                                            echo floor($diff / 86400) . " hari yang lalu";
                                        } elseif ($diff < 2592000) { /* 4 minggu atau kurang lebih 1 bulan */
                                            echo floor($diff / 604800) . " minggu yang lalu";
                                        } elseif ($diff < 31536000) {
                                            echo floor($diff / 2592000) . " bulan yang lalu";
                                        } else {
                                            echo floor($diff / 31536000) . " tahun yang lalu";
                                        }
                                    @endphp
                                </span>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Pagination dengan ellipsis, FIRST dan LAST -->
                    <!-- Pagination untuk Aktivitas -->
                    <div class="mt-3 d-flex justify-content-center">
                        @if ($recentActivities->hasPages())
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <!-- Tombol First dengan ikon Unicode -->
                                    @if (!$recentActivities->onFirstPage())
                                        <li class="page-item">
                                            <a class="page-link page-link-icon" href="{{ $recentActivities->url(1) }}" rel="prev">

                                                &#x00AB;
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Tombol Previous dengan ikon Unicode -->
                                    @if ($recentActivities->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link page-link-icon">
                                                &#x2039;
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link page-link-icon" href="{{ $recentActivities->previousPageUrl() }}">
                                                &#x2039;
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Pagination dengan ... (Ellipsis) -->
                                    @if($recentActivities->currentPage() > 2)
                                        <li class="page-item disabled">
                                            <span class="page-link">...</span>
                                        </li>
                                    @endif

                                    <!-- Pagination Elements (hanya 2 angka di antara ...) -->
                                    @for ($i = max(1, $recentActivities->currentPage() - 1); $i <= min($recentActivities->lastPage(), $recentActivities->currentPage() + 1); $i++)
                                        @if ($i == $recentActivities->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $recentActivities->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endfor

                                    <!-- Pagination dengan ... (Ellipsis) -->
                                    @if($recentActivities->currentPage() < $recentActivities->lastPage() - 1)
                                        <li class="page-item disabled">
                                            <span class="page-link">...</span>
                                        </li>
                                    @endif

                                    <!-- Tombol Next dengan ikon Unicode -->
                                    @if ($recentActivities->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link page-link-icon" href="{{ $recentActivities->nextPageUrl() }}">
                                                &#x203A;
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link page-link-icon">
                                                &#x203A;
                                            </span>
                                        </li>
                                    @endif

                                    <!-- Tombol Last dengan ikon Unicode -->
                                    @if ($recentActivities->currentPage() < $recentActivities->lastPage())
                                        <li class="page-item">
                                            <a class="page-link page-link-icon" href="{{ $recentActivities->url($recentActivities->lastPage()) }}">
                                                &#x00BB;
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Jumlah Setiap Card -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Kategori</h6>
                    <div>
                        <select id="categoryChartType" class="form-select form-select-sm d-inline-block" style="width: auto;">
                            <option value="bar" selected>Grafik Batang</option>    
                            <option value="line">Grafik Garis</option>    
                            <option value="pie">Grafik Lingkaran</option>
                        </select>
                        <button class="btn btn-sm btn-primary" onclick="downloadCSV('categoryChart')">
                            <i class="bi bi-download"></i> Download CSV
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Pengunjung Website -->
    <div class="row mt-4">
        <!-- Grafik Pengunjung Website -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Pengunjung Website</h6>
                    <div>
                        <select id="visitorChartType" class="form-select form-select-sm d-inline-block" style="width: auto;">
                            <option value="line" selected>Grafik Garis</option>
                            <option value="bar">Grafik Batang</option>    
                            <option value="pie">Grafik Lingkaran</option>
                        </select>
                        <button class="btn btn-sm btn-primary" onclick="downloadCSV('visitorChart')">
                            <i class="bi bi-download"></i> Download CSV
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Total Pengunjung (Vertikal ke Bawah) -->
        <div class="col-xl-6 col-lg-6">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card new-primary">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="bi bi-calendar-day me-2"></i>
                                Total Pengunjung Hari Ini
                            </h6>
                            <h2 class="card-text mb-0">{{ number_format($visitorStats['today']) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card new-info">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="bi bi-calendar-week me-2"></i>
                                Total Pengunjung Minggu Ini
                            </h6>
                            <h2 class="card-text mb-0">{{ number_format($visitorStats['week']) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card new-warning">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="bi bi-calendar-month me-2"></i>
                                Total Pengunjung Bulan Ini
                            </h6>
                            <h2 class="card-text mb-0">{{ number_format($visitorStats['month']) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Tambahkan padding atau margin jika diperlukan */
        .form-select {
            margin-right: 10px;
        }

        /* Custom styling for the cards to ensure left alignment */
        /* Parent card harus memiliki position: relative agar anaknya bisa diatur absolut */
        .card-custom {
            position: relative;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 8px;
            font-size: 1.3rem;
        }

        /* Posisi ikon di pojok kanan bawah */
        .card-icon {
            position: absolute;
            right: 15px; /* Mengatur jarak dari kanan */
            bottom: 15px; /* Mengatur jarak dari bawah */
            font-size: 1.8rem; /* Ukuran ikon */
        }

        .card-custom .text-xs,
        .card-custom .h5,
        .card-custom .font-weight-bold {
            text-align: left;
            font-family: inherit; /* Gunakan font standar */
            font-size: inherit;   /* Gunakan ukuran font standar */
        }

        .card-custom:hover {
            transform: scale(1.03) rotateY(2deg) rotateX(2deg);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .border-left-primary { border-left: 3px solid #007bff !important; }
        .border-left-success { border-left: 3px solid #28a745 !important; }
        .border-left-info { border-left: 3px solid #ec1c24 !important; }
        .border-left-danger { border-left: 3px solid #17a2b8 !important; }
        .border-left-warning { border-left: 3px solid #fd7e14 !important; }

        .card-primary { background-color: #007bff; color: white; }
        .card-success { background-color: #28a745; color: white; }
        .card-info { background-color: #ec1c24; color: white; }
        .card-danger { background-color: #17a2b8; color: white; }
        .card-warning { background-color: #fd7e14; color: white; }

        .card-icon { 
            font-size: 1.8rem; 
        }

        .card-body-custom { 
            padding: 0.85rem; 
        }

        .card-body-custom .font-weight-bold { 
            font-weight: bold;
            font-size: 1.3rem; /* Ukuran untuk teks tebal */ 
        }

        /* Custom styles for dashboard cards */
        .card-custom .text-xs {
            font-size: 0.9rem;
        }

        .card-custom .h5 {
            font-size: 1.5rem;
        }

        /* Spacing for card rows */
        .row.g-2 {
            margin-bottom: 2.5rem;
        }

        .row.mt-4 {
            margin-top: 1rem !important;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .card-custom {
                font-size: 1rem;
            }
            .card-icon {
                font-size: 1.8rem;
            }
            .card-custom .text-xs {
                font-size: 0.9rem;
            }
            .card-custom .h5 {
                font-size: 1.15rem;
            }
            .row.g-2 {
                margin-bottom: 1.5rem;
            }
            .row.mt-4 {
                margin-top: 1rem !important;
            }
        }

        @media (max-width: 768px) {
            .card-custom {
                font-size: 1rem;
            }
            .card-icon {
                font-size: 1.6rem;
            }
            .card-custom .text-xs {
                font-size: 0.9rem;
            }
            .card-custom .h5 {
                font-size: 1.1rem;
            }
            .row.g-2 {
                margin-bottom: 1.5rem;
            }
            .row.mt-4 {
                margin-top: 1rem !important;
            }
        }

        /* Warna dasar untuk card */
        .card.new-primary { 
            background-color: #007bff; 
            color: white; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Menambahkan efek transisi */
        }

        .card.new-info { 
            background-color: #ec1c24; /* Menggunakan warna merah seperti yang diminta */ 
            color: white; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Menambahkan efek transisi */
        }

        .card.new-warning { 
            background-color: #fd7e14; 
            color: white; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Menambahkan efek transisi */
        }

        /* Efek hover untuk semua card */
        .card.new-primary:hover,
        .card.new-info:hover,
        .card.new-warning:hover {
            transform: scale(1.03) rotateY(2deg) rotateX(2deg);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection

@section('additional_js')
<script>
    // Greeting message
    function updateGreeting() {
        var greetingElement = document.getElementById('greetingMessage');
        var jakartaTime = new Date().toLocaleString("en-US", { timeZone: "Asia/Jakarta" });
        var currentHour = new Date(jakartaTime).getHours();
        var greeting;

        if (currentHour >= 5 && currentHour < 11) {
            greeting = "Selamat Pagi";
        } else if (currentHour >= 11 && currentHour < 15) {
            greeting = "Selamat Siang";
        } else if (currentHour >= 15 && currentHour < 18) {
            greeting = "Selamat Sore";
        } else {
            greeting = "Selamat Malam";
        }

        greetingElement.textContent = greeting + ", Admin!";
    }

    // Update greeting on load and every minute
    updateGreeting();
    setInterval(updateGreeting, 60000);

    // Inisialisasi Data untuk Grafik Pengunjung Website (Minggu sampai Sabtu)
    const visitorDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    // Data pengunjung diambil dari server, bukan localStorage
    const visitorData = @json($visitorCount); // Mengambil data dari controller

    // Warna-warna untuk setiap hari (agar lebih menarik)
    const visitorColors = [
        'rgba(255, 99, 132, 0.6)',  // Warna untuk Minggu
        'rgba(54, 162, 235, 0.6)',  // Warna untuk Senin
        'rgba(255, 206, 86, 0.6)',  // Warna untuk Selasa
        'rgba(75, 192, 192, 0.6)',  // Warna untuk Rabu
        'rgba(153, 102, 255, 0.6)', // Warna untuk Kamis
        'rgba(255, 159, 64, 0.6)',  // Warna untuk Jumat
        'rgba(201, 203, 207, 0.6)'  // Warna untuk Sabtu
    ];

    const borderColors = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(201, 203, 207, 1)'
    ];

    // Fungsi untuk memperbarui jumlah pengunjung
    function updateVisitorCount() {
        // Dapatkan hari saat ini (0 untuk Minggu, 6 untuk Sabtu)
        const currentDay = new Date().getDay();
        // Perbarui grafik dengan data terbaru
        updateVisitorChart();
    }

    // Fungsi untuk membuat atau memperbarui grafik pengunjung
    function updateVisitorChart() {
        const visitorCtx = document.getElementById('visitorChart').getContext('2d');
        const selectedType = document.getElementById('visitorChartType').value; // Ambil jenis grafik dari dropdown

        if (visitorCtx.chart) {
            visitorCtx.chart.destroy(); // Hapus grafik sebelumnya jika sudah ada
        }

        // Membuat grafik baru dengan data yang sudah diperbarui
        visitorCtx.chart = new Chart(visitorCtx, {
            type: selectedType, // Gunakan jenis grafik dari dropdown (line, bar, atau pie)
            data: {
                labels: visitorDays, // Label untuk setiap hari dalam seminggu
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: visitorData, // Data pengunjung yang diambil dari localStorage
                    backgroundColor: selectedType === 'pie' || selectedType === 'bar' || selectedType === 'line' ? visitorColors : 'rgba(75, 192, 192, 0.6)', // Warna berbeda untuk pie, bar, dan line
                    borderColor: selectedType === 'pie' || selectedType === 'bar' || selectedType === 'line' ? borderColors : 'rgba(75, 192, 192, 1)', // Warna border
                    borderWidth: 1,
                    fill: selectedType !== 'line' // Jangan isi grafik jika line chart
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: selectedType === 'pie' ? {} : { // Hapus skala untuk pie chart
                    y: {
                        beginAtZero: true // Untuk memastikan grafik dimulai dari nol
                    }
                }
            }
        });
    }

    // Inisialisasi Grafik Pengunjung Website
    updateVisitorChart(); // Inisialisasi pertama kali saat halaman dimuat
    updateVisitorCount();  // Tambahkan pengunjung saat halaman di-refresh

    // Data untuk Grafik Jumlah Setiap Kategori
    const categoryLabels = ['Jasa Konstruksi', 'Manufacturing', 'Jasa Non Konstruksi', 'Capex Procurement', 'Internal Project'];
    const categoryData = [
        {{ $jasaKonstruksiCount }},
        {{ $manufacturingCount }},
        {{ $jasaNonKonstruksiCount }},
        {{ $capexProcurementCount }},
        {{ $internalProjectCount }}
    ];

    // Fungsi untuk membuat atau memperbarui grafik jumlah kategori
    function createCategoryChart(ctx, type, labels, data) {
        if (ctx.chart) {
            ctx.chart.destroy();
        }

        ctx.chart = new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Kategori',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Inisialisasi Grafik Jumlah Setiap Kategori
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    let categoryChartType = document.getElementById('categoryChartType').value;
    createCategoryChart(categoryCtx, categoryChartType, categoryLabels, categoryData);

    // Event Listener untuk Dropdown Grafik Pengunjung
    document.getElementById('visitorChartType').addEventListener('change', function() {
        updateVisitorChart(); // Perbarui grafik setiap kali pilihan dropdown berubah
    });

    // Event Listener untuk Dropdown Grafik Jumlah Kategori
    document.getElementById('categoryChartType').addEventListener('change', function() {
        const selectedType = this.value;
        createCategoryChart(categoryCtx, selectedType, categoryLabels, categoryData);
    });

    // Fungsi Download CSV untuk data pengunjung
    function downloadCSV(chartId) {
        let chart, labels, data;
        
        // Memastikan chartId yang diterima adalah 'visitorChart' atau 'categoryChart'
        if (chartId === 'visitorChart') {
            // Referensi ke grafik pengunjung
            chart = document.getElementById('visitorChart').getContext('2d').chart; // Ambil chart dari visitorChart
            labels = visitorDays;  // Label harian (Minggu - Sabtu)
            data = visitorData;    // Data pengunjung
        } else if (chartId === 'categoryChart') {
            // Referensi ke grafik kategori
            chart = document.getElementById('categoryChart').getContext('2d').chart; // Ambil chart dari categoryChart
            labels = categoryLabels;  // Label kategori (Jasa Konstruksi, dsb)
            data = categoryData;      // Data kategori
        }

        // Format CSV
        const csvData = labels.map((label, index) => `${label},${data[index]}`);
        const csvContent = 'data:text/csv;charset=utf-8,' + ['Label,Data', ...csvData].join('\n');

        // Buat dan unduh file CSV
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', `${chartId}.csv`);
        document.body.appendChild(link);  // Diperlukan untuk Firefox
        link.click();  // Unduh otomatis
        document.body.removeChild(link);  // Hapus elemen setelah unduhan
    }
</script>
@endsection