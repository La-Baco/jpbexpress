<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>JPB Express</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href=" {{ asset('assets/template1/img/favicon/favicon.ico') }} " rel="icon">
    <link href=" {{ asset('assets/template2/img/apple-touch-icon.png') }} " rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href=" {{ asset('assets/template2/vendor/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">
    <link href=" {{ asset('assets/template2/vendor/bootstrap-icons/bootstrap-icons.css') }} " rel="stylesheet">
    <link href=" {{ asset('assets/template2/vendor/aos/aos.css') }} " rel="stylesheet">
    <link href=" {{ asset('assets/template2/vendor/glightbox/css/glightbox.min.css') }} " rel="stylesheet">
    <link href=" {{ asset('assets/template2/vendor/swiper/swiper-bundle.min.css') }} " rel="stylesheet">

    <!-- Main CSS File -->
    <link href=" {{ asset('assets/template2/css/main.css') }} " rel="stylesheet">

    <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="#hero" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/template2/img/main_ikon.png') }}" alt="">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#pengiriman">Pengiriman</a></li>
                    <li><a href="#layanan">Layanan</a></li>
                    <li><a href="#tarif">Tarif</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                            <div class="company-badge mb-4">
                                <i class="bi bi-gear-fill me-2"></i>
                                Cepat • Aman • Terpercaya
                            </div>

                            <h1 class="mb-4">
                                JPB Express <br>
                                Solusi Tepat Untuk <br>
                                <span class="accent-text">Setiap Pengiriman Anda</span>
                            </h1>

                            <p class="mb-4 mb-md-5">
                                Dari antar-jemput barang, pengiriman paket online, hingga pemesanan makanan dan
                                kebutuhan sehari-hari ke pulau — semua bisa bersama <b>JPB Express</b>.
                                Nikmati layanan cepat, mudah, dan terpercaya dengan harga bersahabat.
                            </p>

                            <div class="hero-buttons">
                                <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Mulai Kirim Sekarang</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                            <img src=" {{ asset('assets/template2/img/main.png') }} " alt="Hero Image"
                                class="img-fluid">
                        </div>
                    </div>
                </div>


                <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-truck"></i>
                            </div>
                            <div class="stat-content">
                                <h4>2+ Tahun</h4>
                                <p class="mb-0">Pengalaman Pengiriman</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <div class="stat-content">
                                <h4>10k+</h4>
                                <p class="mb-0">Paket Terkirim</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-emoji-smile"></i>
                            </div>
                            <div class="stat-content">
                                <h4>99%</h4>
                                <p class="mb-0">Kepuasan Pelanggan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div class="stat-content">
                                <h4>24/7</h4>
                                <p class="mb-0">Layanan Siap Membantu</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center justify-content-between">

                    <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                        <span class="about-meta">TENTANG KAMI</span>
                        <h2 class="about-title">JPB Express, Solusi Pengiriman Terpercaya</h2>
                        <p class="about-description">
                            JPB Express hadir untuk memudahkan kebutuhan pengiriman Anda, mulai dari antar-jemput
                            barang,
                            kirim paket online ke berbagai pulau, hingga pemesanan barang dan makanan.
                            Dengan layanan cepat, aman, dan terpercaya, kami berkomitmen menjadi mitra terbaik Anda
                            dalam setiap perjalanan paket.
                        </p>

                        <div class="row feature-list-wrapper">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Antar-Jemput Barang</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Terima Paket Online</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Pemesanan Barang</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Pemesanan Antar Pulau</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Layanan Cepat & Aman</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Harga Bersahabat</li>
                                </ul>
                            </div>
                        </div>

                        <div class="info-wrapper">
                            <div class="row gy-4">
                                <div class="col-lg-5">
                                    <div class="profile d-flex align-items-center gap-3">
                                        <img src=" {{ asset('assets/template2/img/ceo.jpg') }} " alt="CEO Profile"
                                            class="profile-image">
                                        <div>
                                            <h4 class="profile-name">Ach. Efendi</h4>
                                            <p class="profile-position">CEO &amp; Founder</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="contact-info d-flex align-items-center gap-2">
                                        <i class="bi bi-telephone-fill"></i>
                                        <div>
                                            <p class="contact-label">Hubungi Kami</p>
                                            <p class="contact-number">+62 859-5676-4737</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="image-wrapper">
                            <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                                <img src=" {{ asset('assets/template2/img/landscape-bg.png') }} "
                                    alt="Pengiriman JPB Express" class="img-fluid main-image rounded-4">
                                <img src=" {{ asset('assets/template2/img/potrait-bg.png') }} " alt="Tim JPB Express"
                                    class="img-fluid small-image rounded-4">
                            </div>
                            <div class="experience-badge floating">
                                <h3>2+ <span>Tahun</span></h3>
                                <p>Berpengalaman di bidang pengiriman</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </section><!-- /About Section -->

        <!-- Features Section -->
        <section id="pengiriman" class="features section">

            <div class="container section-title text-center" data-aos="fade-up">
                @if (isset($pengirimanHariIni) && $pengirimanHariIni)
                    <h2>
                        Cek Pengiriman
                        ({{ \Carbon\Carbon::parse($pengirimanHariIni->tanggal_keberangkatan)->translatedFormat('d') }}
                        -
                        {{ \Carbon\Carbon::parse($pengirimanHariIni->tanggal_distribusi)->translatedFormat('d F Y') }})
                    </h2>
                @else
                    <h2>Cek Pengiriman</h2>
                @endif
                <p>Masukkan kode tracking Anda untuk melihat paket di pengiriman ini.</p>
            </div>

           <!-- Form Tracking -->
<div class="container d-flex justify-content-center">
    <div class="col-12 col-md-8 col-lg-6"> {{-- full di hp, kecil di pc --}}
        @if (session('error'))
            <div class="alert alert-danger text-center shadow-sm rounded-pill">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('tracking.cek') }}" method="POST"
            class="p-4 rounded-4 shadow-lg bg-light border-0" style="transition: transform .2s;"
            onmouseover="this.style.transform='scale(1.02)'"
            onmouseout="this.style.transform='scale(1)'">
            @csrf
            <div class="mb-4 text-center">
                <label for="kode_tracking" class="form-label fw-semibold fs-5 text-primary">
                    Masukkan Kode Tracking
                </label>
                <input type="text" class="form-control text-center rounded-pill shadow-sm mx-auto"
                    id="kode_tracking" name="kode_tracking" placeholder="Masukkan kode"
                    maxlength="9" required style="max-width: 300px;">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                    Lihat Paket Saya
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Hasil Tracking -->
<div class="container d-flex justify-content-center mt-3">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="p-4 rounded-4 shadow-lg text-center bg-white border-0"
            style="transition: transform .2s;" onmouseover="this.style.transform='scale(1.02)'"
            onmouseout="this.style.transform='scale(1)'">

            <h3 class="mb-4 text-primary fw-bold">Paket Anda</h3>

            @if (isset($pelanggan) && $pelanggan)
                <p class="fs-5 fw-semibold">{{ $pelanggan->nama }}</p>
                <div class="mb-3">
                    <p class="fs-5 mb-1 fw-semibold">Jumlah Barang:</p>
                    <span class="badge bg-primary text-white px-3 py-2 fs-6 rounded-pill">
                        {{ $jumlahBarang ?? 0 }}
                    </span>
                </div>

                @if (($jumlahBarang ?? 0) == 0)
                    <div class="alert alert-warning text-center rounded-3 shadow-sm">
                        Anda tidak memiliki paket di priode ini
                    </div>
                @endif
            @else
                <p class="text-muted fst-italic">Silakan masukkan kode tracking Anda untuk melihat paket.</p>
            @endif
        </div>
    </div>
</div>

        </section><!-- /Features Section -->

        <!-- Features Cards Section -->
        <section id="features-cards" class="features-cards section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="feature-box orange">
                            <i class="bi bi-truck"></i>
                            <h4>Antar-Jemput Barang</h4>
                            <p>Layanan praktis untuk menjemput dan mengantarkan barang Anda langsung ke tujuan dengan
                                cepat.</p>
                        </div>
                    </div><!-- End Feature Box-->

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="feature-box blue">
                            <i class="bi bi-box-seam"></i>
                            <h4>Kirim Paket Online</h4>
                            <p>Terima dan kirim paket belanjaan online Anda ke berbagai daerah dan pulau dengan aman.
                            </p>
                        </div>
                    </div><!-- End Feature Box-->

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="feature-box green">
                            <i class="bi bi-basket"></i>
                            <h4>Pemesanan Barang</h4>
                            <p>Bantu pembelian kebutuhan Anda dan kirimkan langsung tanpa ribet, cepat sampai di tangan.
                            </p>
                        </div>
                    </div><!-- End Feature Box-->

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="feature-box red">
                            <i class="bi bi-cup-hot"></i>
                            <h4>Pemesanan Makanan</h4>
                            <p>Kirim makanan ke pulau atau lokasi tujuan dengan kualitas tetap terjaga dan tepat waktu.
                            </p>
                        </div>
                    </div><!-- End Feature Box-->

                </div>

            </div>

        </section><!-- /Features Cards Section -->


        <!-- Features 2 Section -->
        <section id="features-2" class="features-2 section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">

                    <div class="col-lg-4">

                        <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="200">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="feature-content">
                                    <h3>Pengiriman Cepat</h3>
                                    <p>Setiap paket diproses dengan sistem yang terintegrasi sehingga barang sampai
                                        lebih cepat dan tepat waktu.</p>
                                </div>
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-lightning-charge"></i>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                        <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="300">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="feature-content">
                                    <h3>Jangkauan Luas</h3>
                                    <p>Kami melayani pengiriman ke berbagai pulau dan wilayah, menjangkau pelanggan di
                                        mana pun berada.</p>
                                </div>
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-globe2"></i>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                        <div class="feature-item text-end" data-aos="fade-right" data-aos-delay="400">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="feature-content">
                                    <h3>Aman & Terpercaya</h3>
                                    <p>Setiap barang dikirim dengan perlindungan ekstra agar tetap aman hingga sampai
                                        tujuan.</p>
                                </div>
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                    </div>

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="phone-mockup text-center">
                            <img src=" {{ asset('assets/template2/img/phone.png') }} " alt="JPB Express App"
                                class="img-fluid">
                        </div>
                    </div><!-- End Phone Mockup -->

                    <div class="col-lg-4">

                        <div class="feature-item mb-5" data-aos="fade-left" data-aos-delay="200">
                            <div class="d-flex align-items-center gap-4">
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div class="feature-content">
                                    <h3>Dukungan Pelanggan</h3>
                                    <p>Tim support kami selalu siap membantu Anda dalam setiap kebutuhan pengiriman
                                        barang maupun konsultasi layanan.</p>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                        <div class="feature-item mb-5" data-aos="fade-left" data-aos-delay="300">
                            <div class="d-flex align-items-center gap-4">
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <div class="feature-content">
                                    <h3>Pembayaran Mudah</h3>
                                    <p>Nikmati kemudahan pembayaran dengan berbagai metode yang fleksibel dan aman untuk
                                        semua pelanggan.</p>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                        <div class="feature-item" data-aos="fade-left" data-aos-delay="400">
                            <div class="d-flex align-items-center gap-4">
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="feature-content">
                                    <h3>Kepuasan Pelanggan</h3>
                                    <p>Lebih dari ribuan pelanggan telah mempercayakan JPB Express untuk kebutuhan
                                        pengiriman mereka.</p>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                    </div>

                </div>

            </div>

        </section><!-- /Features 2 Section -->

        <!-- Services Section -->
        <section id="layanan" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <p>JPB Express menyediakan berbagai layanan pengiriman yang cepat, aman, dan terpercaya untuk kebutuhan
                    Anda.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-card d-flex">
                            <div class="icon flex-shrink-0">
                                <i class="bi bi-truck"></i>
                            </div>
                            <div>
                                <h3>Jemput & Kirim Barang</h3>
                                <p>Layanan antar-jemput barang langsung dari lokasi Anda hingga sampai tujuan dengan
                                    cepat dan aman.</p>
                            </div>
                        </div>
                    </div><!-- End Service Card -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-card d-flex">
                            <div class="icon flex-shrink-0">
                                <i class="bi bi-bag"></i>
                            </div>
                            <div>
                                <h3>Pemesanan Barang</h3>
                                <p>Bantu pembelian dan pengiriman barang kebutuhan Anda dengan proses mudah dan
                                    terpercaya.</p>
                            </div>
                        </div>
                    </div><!-- End Service Card -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-card d-flex">
                            <div class="icon flex-shrink-0">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <div>
                                <h3>Terima Paket Online</h3>
                                <p>Kami menerima paket belanja online dan mengirimkannya ke tujuan Anda, termasuk ke
                                    berbagai pulau.</p>
                            </div>
                        </div>
                    </div><!-- End Service Card -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-card d-flex">
                            <div class="icon flex-shrink-0">
                                <i class="bi bi-cup-hot"></i>
                            </div>
                            <div>
                                <h3>Pengiriman Makanan & Titipan</h3>
                                <p>Layanan pengiriman makanan atau titipan lainnya ke pulau atau lokasi yang Anda
                                    inginkan, aman dan cepat.</p>
                            </div>
                        </div>
                    </div><!-- End Service Card -->

                </div>

            </div>


        </section><!-- /Services Section -->

        <!-- Pricing Section -->
        <section id="tarif" class="pricing section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tarif Layanan</h2>
                <p>JPB Express menawarkan tarif yang jelas dan kompetitif untuk berbagai jenis pengiriman Anda.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 justify-content-center">

                    <!-- Non-COD Plan -->
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-card">
                            <h3>Non-COD</h3>
                            <div class="price">
                                <span class="currency">Rp.</span>
                                <span class="amount">5.000</span>
                                <span class="period">/ paket</span>
                            </div>
                            <p class="description">Layanan pengiriman standar tanpa Cash on Delivery (COD). Tarif lokal
                                tetap, luar Raas berbeda.</p>

                            <h4>Tarif Luar Pulau Raas:</h4>
                            <ul class="features-list">
                                <li><i class="bi bi-check-circle-fill"></i> Semua paket: Rp 7.000</li>
                            </ul>

                            <h4>Keterangan Tambahan:</h4>
                            <ul class="features-list">
                                <li><i class="bi bi-check-circle-fill"></i> Estimasi pengiriman: 1-2 hari kerja</li>
                                <li><i class="bi bi-check-circle-fill"></i> Pengiriman aman dan terjamin</li>
                                <li><i class="bi bi-check-circle-fill"></i> Cocok untuk paket umum, dokumen, dan barang
                                    ringan</li>
                                <li><i class="bi bi-check-circle-fill"></i> Tracking paket tersedia melalui website
                                </li>
                                <li><i class="bi bi-exclamation-circle"></i> Note: Jika berat paket melebihi standar,
                                    akan dikenakan biaya tambahan sesuai tarif kargo</li>
                            </ul>

                            <a href="https://wa.link/lbg82b" class="btn btn-primary">
                                Berlangganan Sekarang
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>


                    <!-- COD Plan -->
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-card popular">
                            <div class="popular-badge">Most Popular</div>
                            <h3>COD (Cash on Delivery)</h3>
                            <div class="price">
                                <span class="currency">Rp.</span>
                                <span class="amount">6.000 - 15.000</span>
                                <span class="period">/ paket</span>
                            </div>
                            <p class="description">Layanan COD memungkinkan penerima membayar paket saat diterima.
                                Tarif menyesuaikan harga paket dan lokasi pengiriman.</p>

                            <h4>Tarif COD Berdasarkan Harga Paket:</h4>
                            <ul class="features-list">
                                <li><i class="bi bi-check-circle-fill"></i> Paket Rp 1.000 - 150.000 → Rp 6.000</li>
                                <li><i class="bi bi-check-circle-fill"></i> Paket Rp 150.001 - 250.000 → Rp 7.000</li>
                                <li><i class="bi bi-check-circle-fill"></i> Paket Rp 250.001 - 500.000 → Rp 8.000</li>
                                <li><i class="bi bi-check-circle-fill"></i> Paket Rp 500.001 - 1.000.000 → Rp 12.000
                                </li>
                                <li><i class="bi bi-check-circle-fill"></i> Luar Pulau Raas:
                                    Rp 150.001 - 250.000 → Rp 9.000, Rp 500.000 → Rp 12.000, Rp 500.001 - 1.000.000 → Rp
                                    15.000
                                </li>
                            </ul>

                            <a href="https://wa.link/lbg82b" class="btn btn-light">
                                Berlangganan Sekarang
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Order Plan -->
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="pricing-card">
                            <h3>Order Khusus</h3>
                            <div class="price">
                                <span class="currency">Rp.</span>
                                <span class="amount">7.000+</span>
                                <span class="period">/ paket</span>
                            </div>
                            <p class="description">Layanan pengiriman untuk barang yang diorder khusus. Tarif
                                menyesuaikan jenis dan harga barang yang dipesan.</p>

                            <h4>Fitur & Keterangan:</h4>
                            <ul class="features-list">
                                <li><i class="bi bi-check-circle-fill"></i> Tarif mulai Rp 7.000 per paket</li>
                                <li><i class="bi bi-check-circle-fill"></i> Menyesuaikan jenis & harga barang</li>
                                <li><i class="bi bi-check-circle-fill"></i> Pengiriman aman & cepat</li>
                            </ul>

                            <a href="https://wa.link/lbg82b" class="btn btn-primary">
                                Berlangganan Sekarang
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>


            <!-- Faq Section -->
            <section class="faq-9 faq section light-background" id="faq">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5" data-aos="fade-up">
                            <h2 class="faq-title">Punya Pertanyaan? Cek FAQ Kami</h2>
                            <p class="faq-description">Berikut beberapa pertanyaan yang sering ditanyakan pelanggan
                                kami seputar layanan pengiriman JPB Express.</p>
                        </div>

                        <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
                            <div class="faq-container">

                                <div class="faq-item faq-active">
                                    <h3>Apa perbedaan layanan COD dan Non-COD?</h3>
                                    <div class="faq-content">
                                        <p>Non-COD adalah layanan pengiriman standar tanpa pembayaran di tempat,
                                            sementara COD memungkinkan penerima membayar paket saat diterima. Tarif COD
                                            sedikit lebih tinggi karena proses penagihan.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div>

                                <div class="faq-item">
                                    <h3>Berapa tarif pengiriman paket di JPB Express?</h3>
                                    <div class="faq-content">
                                        <p>Tarif tergantung jenis layanan dan lokasi: <br>
                                            - Non-COD lokal: Rp 5.000/paket <br>
                                            - Non-COD luar Raas: Rp 7.000/paket <br>
                                            - COD lokal: Rp 6.000 - 12.000/paket tergantung harga paket <br>
                                            - COD luar Raas: Rp 9.000 - 15.000/paket <br>
                                            Paket berat akan dikenakan biaya tambahan sesuai tarif kargo.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div>

                                <div class="faq-item">
                                    <h3>Berapa lama estimasi pengiriman?</h3>
                                    <div class="faq-content">
                                        <p>Estimasi pengiriman adalah 1-2 hari untuk area lokal dan 2-3 hari untuk luar
                                            Raas. Untuk paket berat atau jauh dari rute utama, waktu pengiriman bisa
                                            lebih lama.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div>

                                <div class="faq-item">
                                    <h3>Apakah paket saya aman?</h3>
                                    <div class="faq-content">
                                        <p>Semua paket dikemas dengan aman dan diawasi. Kami juga menyediakan sistem
                                            tracking untuk memantau lokasi paket secara real-time hingga sampai ke
                                            tujuan.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div>

                                <div class="faq-item">
                                    <h3>Apakah JPB Express menerima paket makanan atau barang khusus?</h3>
                                    <div class="faq-content">
                                        <p>Ya, kami menerima pengiriman makanan dan barang khusus. Pastikan paket
                                            dikemas sesuai standar keamanan dan ketahanan untuk perjalanan antar pulau.
                                        </p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div>

                                <div class="faq-item">
                                    <h3>Bagaimana cara memesan layanan JPB Express?</h3>
                                    <div class="faq-content">
                                        <p>Pelanggan dapat memesan melalui website, aplikasi, atau menghubungi layanan
                                            pelanggan kami. Tersedia opsi jemput barang untuk kenyamanan tambahan.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section><!-- /Faq Section -->


            <!-- Contact Section -->
            <section id="contact" class="contact section light-background">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Kontak Kami</h2>
                    <p>Hubungi JPB Express untuk layanan pengiriman paket dan informasi tarif.</p>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row g-4 g-lg-5">
                        <div class="col-lg-5">
                            <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                                <h3>Informasi Kontak</h3>
                                <p>JPB Express melayani pengiriman paket ke seluruh pulau dengan aman dan cepat. Hubungi
                                    kami untuk pemesanan dan pertanyaan layanan.</p>

                                <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                                    <div class="icon-box">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h4>Lokasi Kami</h4>
                                        <p>Jln. Adirasa, Kolos Sumenep, Toko Barokah</p>
                                        <p>Sebelah Timur Istana Parfum, pertigaan Kota Sumenep, Jawa Timur, 69417</p>
                                    </div>
                                </div>

                                <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                    <div class="icon-box">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div class="content">
                                        <h4>Nomor Telepon</h4>
                                        <p>+62 859-5676-4737</p>
                                    </div>
                                </div>

                                <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                                    <div class="icon-box">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div class="content">
                                        <h4>Email</h4>
                                        <p>jpbexpress@gmail.com</p>
                                        <p>csjpbexpress@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </section><!-- /Contact Section -->


    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">JPBExpress</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jln. Adirasa, Kolos Sumenep, Toko Barokah</p>
                        <p>Sebelah Timur Istana Parfum, pertigaan Kota Sumenep, Jawa Timur, 69417</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>>+62 859-5676-4737</span></p>
                        <p><strong>Email:</strong> <span>jpbexpress@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">

        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src=" {{ asset('assets/template2/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <script src=" {{ asset('assets/template2/vendor/php-email-form/validate.js') }}"></script>
    <script src=" {{ asset('assets/template2/vendor/aos/aos.js') }} "></script>
    <script src=" {{ asset('assets/template2/vendor/glightbox/js/glightbox.min.js') }} "></script>
    <script src=" {{ asset('assets/template2/vendor/swiper/swiper-bundle.min.js') }} "></script>
    <script src=" {{ asset('assets/template2/vendor/purecounter/purecounter_vanilla.js') }} "></script>

    <!-- Main JS File -->
    <script src=" {{ asset('assets/template2/js/main.js') }} "></script>

</body>

</html>
