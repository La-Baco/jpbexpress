@extends('layouts.app')

@section('title', 'Manajemen Area')

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
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Data Area</h5>
            <!-- Tombol Tambah -->
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddArea">
                <i class="bx bx-plus"></i> Tambah Area
            </button>
        </div>



        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            @forelse ($areas as $area)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <!-- Bagian atas card -->
                        <div class="d-flex align-items-center justify-content-center rounded-2"
                            style="background: linear-gradient(135deg, #6fb1fc, #4364f7); height: 170px;">
                            <i class="bx bx-map text-white" style="font-size: 4rem;"></i>
                        </div>

                        <!-- Card body -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2" style="font-size: 1.5rem;">{{ $area->nama_area }}</h5>
                            <p class="text-muted mb-3">
                                <i class="bx bx-user"></i> {{ $area->kurir->name ?? '-' }}
                            </p>

                            <div class="mt-auto d-flex ">
                                <!-- Edit -->
                                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#modalEditArea{{ $area->id }}">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <!-- Delete -->
                                <form action="{{ route('admin.area.destroy', $area->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus area ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm me-2">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal Edit Area -->
                <div class="modal fade" id="modalEditArea{{ $area->id }}" tabindex="-1"
                    aria-labelledby="modalEditAreaLabel{{ $area->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.area.update', $area->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditAreaLabel{{ $area->id }}">Edit Area</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Area</label>
                                        <input type="text" name="nama_area" value="{{ $area->nama_area }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kurir</label>
                                        <select name="user_id" class="form-select">
                                            <option value="">-- Pilih Kurir --</option>
                                            @foreach ($kurirs as $kurir)
                                                <option value="{{ $kurir->id }}"
                                                    {{ $kurir->id == $area->user_id ? 'selected' : '' }}>
                                                    {{ $kurir->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="card h-100 text-center d-flex align-items-center justify-content-center p-4">
                        <div class="card-body">
                            <i class="bx bx-info-circle bx-lg mb-2"></i>
                            <p class="mb-0">Belum ada area yang ditambahkan</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Tambah Area -->
    <div class="modal fade" id="modalAddArea" tabindex="-1" aria-labelledby="modalAddAreaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.area.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddAreaLabel">Tambah Area</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Area</label>
                            <input type="text" name="nama_area" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kurir</label>
                            <select name="user_id" class="form-select" >
                                <option value="">-- Pilih Kurir --</option>
                                @foreach ($kurirs as $kurir)
                                    <option value="{{ $kurir->id }}">{{ $kurir->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
