@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Jika ada validasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
            <form id="uploadForm" action="{{ route('admin.profile.updateFoto') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ $user->foto ? asset('storage/foto_user/' . $user->foto) : asset('assets/img/avatars/1.png') }}"
                        alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"
                        style="cursor:pointer" onclick="document.getElementById('upload').click()" {{-- klik foto juga bisa upload --}} />

                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" name="foto" hidden accept="image/png, image/jpeg"
                                onchange="document.getElementById('uploadForm').submit()" {{-- langsung submit --}} />
                        </label>

                        <p class="text-muted mb-0">Allowed JPG or PNG. Max size of 800K</p>
                    </div>
                </div>
            </form>
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $user->name) }}" autofocus>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="telpon">Telepon</label>
                        <input type="text" id="telpon" name="telpon" class="form-control"
                            value="{{ old('telpon', $user->telpon) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            value="{{ old('alamat', $user->alamat) }}">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="motto" class="form-label">Motto</label>
                        <input type="text" class="form-control" id="motto" name="motto"
                            value="{{ old('motto', $user->motto) }}">
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <h3>Change Password</h3>
            <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
                @csrf
                <div class="row position-relative">
                    <!-- Password Lama -->
                    <div class="mb-3 col-md-12 position-relative">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <span class="toggle-password" style="position:absolute; right:20px; top:38px; cursor:pointer;"
                            onclick="togglePassword('current_password', this)">
                            <i class="bx bx-show"></i>
                        </span>
                    </div>

                    <!-- Password Baru -->
                    <div class="mb-3 col-md-12 position-relative">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                        <span class="toggle-password" style="position:absolute; right:20px; top:38px; cursor:pointer;"
                            onclick="toggleNewPasswords(this)">
                            <i class="bx bx-show"></i>
                        </span>
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="mb-3 col-md-12 position-relative">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation"
                            name="new_password_confirmation">

                    </div>
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Change Password</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </form>
        </div>

    </div>
    <script>
        // Toggle untuk password lama tetap terpisah
        function togglePassword(fieldId, icon) {
            const input = document.getElementById(fieldId);
            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = '<i class="bx bx-hide"></i>';
            } else {
                input.type = "password";
                icon.innerHTML = '<i class="bx bx-show"></i>';
            }
        }

        // Toggle untuk password baru dan konfirmasi password baru sekaligus
        function toggleNewPasswords(icon) {
            const newPass = document.getElementById('new_password');
            const confirmPass = document.getElementById('new_password_confirmation');
            const type = newPass.type === "password" ? "text" : "password";

            newPass.type = type;
            confirmPass.type = type;

            // Ganti ikon
            icon.innerHTML = type === "text" ? '<i class="bx bx-hide"></i>' : '<i class="bx bx-show"></i>';
        }
    </script>

    <script>
        function previewAndSubmit() {
            const input = document.getElementById('upload');
            const avatar = document.getElementById('uploadedAvatar');

            if (input.files && input.files[0]) {
                // Preview langsung
                const reader = new FileReader();
                reader.onload = e => avatar.src = e.target.result;
                reader.readAsDataURL(input.files[0]);

                // Submit otomatis
                document.getElementById('uploadForm').submit();
            }
        }

        function resetFoto() {
            document.getElementById('uploadedAvatar').src = "{{ asset('assets/img/avatars/1.png') }}";
            // kalau mau langsung hapus di server juga → panggil route reset via AJAX atau buat form khusus reset
        }
    </script>
@endsection
