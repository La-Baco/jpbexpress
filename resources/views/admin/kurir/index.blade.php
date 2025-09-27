@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akun /</span> Kurir</h4>

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

    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Akun Kurir</h5>
            <!-- Tombol Tambah (modal trigger) -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddKurir">
                <i class="bx bx-plus"></i> Add
            </button>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telpon</th>
                        <th>Alamat</th>
                        <th >Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($kurirs as $kurir)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kurir->name }}</td>
                            <td>{{ $kurir->email }}</td>
                            <td>{{ $kurir->telpon ?? '-' }}</td>
                            <td>{{ $kurir->alamat ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- View -->
                                    <a href="{{ route('admin.kurir.show', $kurir->id) }}" class="btn btn-sm btn-info"
                                        title="View">
                                        <i class="bx bx-show"></i>
                                    </a>

                                    <!-- Edit -->
                                    <button type="button" class="btn btn-sm btn-warning" title="Edit"
                                        data-bs-toggle="modal" data-bs-target="#modalEditKurir{{ $kurir->id }}">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.kurir.destroy', $kurir->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus kurir ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>


                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data kurir</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Hoverable Table rows -->

    <!-- Modal Tambah Kurir -->
    <div class="modal fade" id="modalAddKurir" tabindex="-1" aria-labelledby="modalAddKurirLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.kurir.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddKurirLabel">Add Kurir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="addPassword" required
                                    minlength="6">
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePassword('addPassword')">
                                    <i class="bx bx-show"></i>
                                </button>
                            </div>
                            <small class="text-muted">Minimal 6 karakter</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="addPasswordConfirm" required minlength="6">
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePassword('addPasswordConfirm')">
                                    <i class="bx bx-show"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telpon (opsional)</label>
                            <input type="text" class="form-control" name="telpon">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat (opsional)</label>
                            <textarea class="form-control" name="alamat" rows="3"></textarea>
                        </div>

                        <input type="hidden" name="role" value="kurir">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Edit Kurir -->
    @foreach ($kurirs as $kurir)
        <div class="modal fade" id="modalEditKurir{{ $kurir->id }}" tabindex="-1"
            aria-labelledby="modalEditKurirLabel{{ $kurir->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('admin.kurir.update', $kurir->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditKurirLabel{{ $kurir->id }}">Edit Kurir</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $kurir->name }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $kurir->email }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password"
                                        id="editPassword{{ $kurir->id }}" minlength="6">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="togglePassword('editPassword{{ $kurir->id }}')">
                                        <i class="bx bx-show"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="editPasswordConfirm{{ $kurir->id }}" minlength="6">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="togglePassword('editPasswordConfirm{{ $kurir->id }}')">
                                        <i class="bx bx-show"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Telpon (opsional)</label>
                                <input type="text" class="form-control" name="telpon" value="{{ $kurir->telpon }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat (opsional)</label>
                                <textarea class="form-control" name="alamat" rows="3">{{ $kurir->alamat }}</textarea>
                            </div>

                            <input type="hidden" name="role" value="kurir">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @section('js')
        <script>
            function togglePassword(id) {
                const input = document.getElementById(id);
                if (input.type === "password") {
                    input.type = "text";
                } else {
                    input.type = "password";
                }
            }
        </script>

    @endsection

@endsection
