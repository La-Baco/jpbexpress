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
                            <img src="{{ asset('assets/template1/img/illustrations/man-with-laptop-light.png') }}"
                                height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
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
                                    <img src="{{ asset('assets/template1/img/icons/unicons/chart-success.png') }}"
                                        alt="chart success" class="rounded" />
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Selesai</span>
                            <h3 class="card-title mb-2">{{ $selesai }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/template1/img/icons/unicons/wallet-info.png') }}"
                                        alt="Credit Card" class="rounded" />
                                </div>

                            </div>
                            <span>Prosess</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $proses }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Revenue -->
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="text-center">
                            </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">Pengiriman</div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-primary p-2"><i
                                            class="bx bx-package text-primary"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>Sekarang</small>
                                    <h6 class="mb-0">{{ $totalBarang }}</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-info p-2"><i class="bx bx-history text-info"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>Sebelumnya</small>
                                    <h6 class="mb-0">{{ $totalBarangSebelumnya }}</h6>
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
                                        alt="Credit Card" class="rounded" />
                                </div>

                            </div>
                            <span class="d-block mb-1">Tertunda</span>
                            <h3 class="card-title text-nowrap mb-2">{{ $tertunda }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/template1/img/icons/unicons/cc-primary.png') }}"
                                        alt="Credit Card" class="rounded" />
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Total Barang</span>
                            <h3 class="card-title mb-2">{{ $totalBarang }}</h3>
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
                                        <span class="badge bg-label-warning rounded-pill">Harga</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <h5 class="mb-0">Rp {{ number_format($totalHarga, 0, ',', '.') }}</h5>
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
@endsection
