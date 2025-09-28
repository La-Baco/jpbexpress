@extends('layouts.app')

@section('title', 'Pelanggan ')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akun /</span> Pelanggan</h4>
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
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <h5 class="mb-0">Pelanggan</h5>

                <div>
                    <!-- Import Excel (hidden input) -->
                    <form id="formImport" action="{{ route('admin.pelanggan.import') }}" method="POST"
                        enctype="multipart/form-data" class="d-inline">
                        @csrf
                        <input type="file" name="file" id="fileInput" class="d-none" accept=".xlsx,.xls,.csv">
                        <button type="button" class="btn btn-success btn-sm me-2"
                            onclick="document.getElementById('fileInput').click();">
                            <i class="bx bx-upload"></i> Import Excel
                        </button>
                    </form>

                    <!-- Tombol Tambah (modal trigger) -->
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#tambahModal">
                        <i class="bx bx-plus"></i> Add
                    </button>
                </div>
            </div>
            <!-- Form Search (tepat di bawah judul pelanggan) -->
            <form action="{{ route('admin.pelanggan.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm me-2"
                    placeholder="Cari pelanggan...">
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    <i class="bx bx-search"></i>
                </button>
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Area</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($pelanggan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->telpon }}</td>
                            <td>{{ $p->area->nama_area ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">



                                    <!-- Edit -->
                                    <button type="button" class="btn btn-sm btn-warning" title="Edit"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $p->id }}">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.pelanggan.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus pelanggan ini?')" style="display:inline;">
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

    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.pelanggan.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telpon" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Area</label>
                        <select name="area_id" class="form-select" required>
                            <option value="">-- Pilih Area --</option>
                            @foreach (\App\Models\Area::all() as $area)
                                <option value="{{ $area->id }}">{{ $area->nama_area }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    {{-- Modal Edit --}}
    @foreach ($pelanggan as $p)
        <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.pelanggan.update', $p->id) }}" method="POST" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $p->nama }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Telepon</label>
                            <input type="text" name="telpon" class="form-control" value="{{ $p->telpon }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="2" required>{{ $p->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Area</label>
                            <select name="area_id" class="form-select" required>
                                <option value="">-- Pilih Area --</option>
                                @foreach (\App\Models\Area::all() as $area)
                                    <option value="{{ $area->id }}" {{ $p->area_id == $area->id ? 'selected' : '' }}>
                                        {{ $area->nama_area }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach


    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            // validasi extension
            const ext = file.name.split('.').pop().toLowerCase();
            if (!['xlsx', 'xls', 'csv'].includes(ext)) {
                alert('Format file harus .xlsx, .xls, atau .csv');
                this.value = '';
                return;
            }

            // validasi ukuran (contoh max 5 MB)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Ukuran file terlalu besar (maks 5MB).');
                this.value = '';
                return;
            }

            // submit form
            document.getElementById('formImport').submit();
        });
    </script>



@endsection
