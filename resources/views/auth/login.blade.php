<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/template1/img/favicon/favicon.ico') }} " />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/template1/vendor/fonts/boxicons.css') }} " />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/template1/vendor/css/core.css') }} " class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/template1/vendor/css/theme-default.css') }} " class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/template1/css/demo.css') }} " />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/template1/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }} " />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/template1/vendor/css/pages/page-auth.css') }} " />
    <!-- Helpers -->
    <script src="{{ asset('assets/template1/vendor/js/helpers.js') }} "></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset(' assets/template1/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="{{ URL('/') }}" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="{{ asset('assets/template1/img/elements/ikon.png') }}" alt="">
                  </span>
                  {{-- <span class="app-brand-text demo text-body fw-bolder">jpb express</span> --}}
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to JPB Express!</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bx bx-error-circle me-2"></i> <!-- Ikon peringatan -->
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
              <form id="formAuthentication" class="mb-3" action="{{ route('login.process') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email or Username</label>
        <input
            type="text"
            class="form-control"
            id="email"
            name="email"
            placeholder="Enter your email or username"
             value="{{ old('email') }}"
            required
            autofocus
        />
    </div>
    <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Password</label>
            <a href="">
                <small>Forgot Password?</small>
            </a>
        </div>
        <div class="input-group input-group-merge">
            <input
                type="password"
                id="password"
                class="form-control"
                name="password"
                required
                placeholder="••••••••"
                aria-describedby="password"
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember-me" />
            <label class="form-check-label" for="remember-me"> Remember Me </label>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
    </div>
</form>


              {{-- <p class="text-center">
                <span>New on our platform?</span>
                <a href="auth-register-basic.html">
                  <span>Create an account</span>
                </a>
              </p> --}}


            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->



    <!-- Core JS -->
    <!-- build:js assets/template1/vendor/js/core.js -->
    <script src="{{ asset(' assets/template1/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/template1/vendor/libs/popper/popper.js') }} "></script>
    <script src="{{ asset(' assets/template1/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/template1/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }} "></script>

    <script src="{{ asset('assets/template1/vendor/js/menu.js') }} "></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/template1/js/main.js') }} "></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
