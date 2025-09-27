@extends('layouts.app')

@section('title', 'Dashboard JPB')

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                Selamat Datang, {{ Auth::user()->name }}! 🎉
                            </h5>
                            <p class="mb-4">
                                Senang melihatmu kembali. Semoga harimu menyenangkan 😊
                            </p>
                        </div>

                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../assets/template1/img/illustrations/man-with-laptop-light.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/template1/img/icons/unicons/cc-primary.png') }}"
                                        alt="Total Area" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Pelanggan</span>
                            <h3 class="card-title mb-2">{{ number_format($totalPelanggan) }}</h3>
                            {{-- Optional: jika ada persentase perubahan, bisa ditambahkan --}}
                            {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/template1/img/icons/unicons/wallet-info.png') }}"
                                        alt="Kurir" class="rounded" />
                                </div>
                            </div>
                            <span>Kurir</span>
                            <h3 class="card-title text-nowrap mb-1">{{ number_format($totalKurir) }}</h3>
                            {{-- Optional: persentase perubahan --}}
                            {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Total Revenue / Statistik Pengiriman -->
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Statistik Pengiriman</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="dropdown">
                                    <!-- Optional dropdown -->
                                </div>
                            </div>
                        </div>

                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">
                            {{-- Contoh: persentase growth, bisa dihitung di controller --}}
                            {{ $growthPercent ?? '62%' }} Company Growth
                        </div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-primary p-2">
                                        <i class="bx bx-dollar text-primary"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>Proses</small>
                                    <h6 class="mb-0">
                                        {{ number_format($pengirimanStats['proses'] ?? 0 * ($pendapatanLatest ?? 0), 2) }}
                                    </h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-info p-2">
                                        <i class="bx bx-wallet text-info"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>Selesai</small>
                                    <h6 class="mb-0">
                                        {{ number_format($pengirimanStats['selesai'] ?? 0 * ($pendapatanLatest ?? 0), 2) }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--/ Total Revenue -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/template1/img/icons/unicons/paypal.png') }}"
                                        alt="Pengiriman Terbaru" class="rounded" />
                                </div>
                            </div>
                            <span class="d-block mb-1">Pengiriman Terbaru</span>
                            <h3 class="card-title text-nowrap mb-2">
                                {{ $totalBarangLatest ?? 0 }}
                            </h3>

                            @php
                                $selisih = $totalBarangLatest - $totalBarangPrevious;
                                $warna = $selisih >= 0 ? 'text-success' : 'text-danger';
                                $ikon = $selisih >= 0 ? 'bx-up-arrow-alt' : 'bx-down-arrow-alt';
                            @endphp

                            <small class="{{ $warna }} fw-semibold">
                                <i class="bx {{ $ikon }}"></i>
                               + {{ abs($selisih) }} dari sebelumnya
                            </small>
                        </div>

                    </div>
                </div>

                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">

                                    <img src="{{ asset('assets/template1/img/icons/unicons/chart-success.png') }}"
                                        alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Area</span>
                            <h3 class="card-title mb-2">{{ number_format($totalArea) }}</h3>
                            {{-- Optional: persentase perubahan --}}
                            {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Profile Report</h5>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <h5 class="mb-0">Rp {{ number_format($pendapatanKeseluruhan, 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                                <div id="profileReportChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Statistics -->
        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Order Statistics</h5>
                        <small class="text-muted">
                            Total Pengiriman
                            {{ $latestPengiriman ? \Carbon\Carbon::parse($latestPengiriman->tanggal)->format('d M Y') : '-' }}
                        </small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $totalBarangLatest }}</h2>
                            <span>Total Barang</span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                    </div>

                    <ul class="p-0 m-0">
                        @forelse ($areaStats as $area)
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="bx bx-package"></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ $area->area }}</h6>
                                        <small class="text-muted">Rp
                                            {{ number_format($area->total_harga, 0, ',', '.') }}</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ $area->total_barang }}</small>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="d-flex">
                                <span class="text-muted">Belum ada data</span>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
        <!--/ Order Statistics -->

        <!-- Expense Overview -->
        <div class="col-md-6 col-lg-4 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header">

                </div>
                <div class="card-body px-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                            <div class="d-flex p-4 pt-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="{{ asset('assets/template1/img/icons/unicons/wallet.png') }}"
                                        alt="User" />
                                </div>
                                <div>
                                    <small class="text-muted d-block">Total Pendapatan</small>
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">Rp {{ number_format($pendapatanKeseluruhan, 0, ',', '.') }}
                                        </h6>
                                    </div>

                                    <small class="text-muted d-block mt-2">Pendapatan Pengiriman Terbaru
                                        ({{ $latestPengiriman ? \Carbon\Carbon::parse($latestPengiriman->tanggal)->format('d M Y') : '-' }})
                                    </small>
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">Rp {{ number_format($pendapatanLatest, 0, ',', '.') }}</h6>
                                    </div>

                                </div>
                            </div>
                            <div id="incomeChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Expense Overview -->

        <!-- Transactions -->
        <div class="col-md-6 col-lg-4 order-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Kinerja Kurir</h5>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        @forelse($kinerjaKurir as $data)
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class="bx bx-user"></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ $data['kurir'] }}</h6>
                                        <div class="d-flex gap-2 mt-1">
                                            <span class="badge bg-label-success">
                                                Selesai: {{ $data['selesai'] }}
                                            </span>
                                            <span class="badge bg-label-primary">
                                                Proses: {{ $data['proses'] }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">{{ $data['total_barang'] }}</h6>
                                        <span class="text-muted">Barang</span>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <p class="text-muted">Belum ada data kurir di pengiriman terbaru</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Transactions -->
    </div>
@endsection
