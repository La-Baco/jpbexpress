@extends('layouts.app')

@section('title', 'Barang Pengiriman')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pengiriman /</span> Barang
    </h4>

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
                @php
                    use Carbon\Carbon;

                    $tglAwal = Carbon::parse($pengiriman->tanggal_keberangkatan);
                    $tglAkhir = Carbon::parse($pengiriman->tanggal_distribusi);
                @endphp

                <h5 class="mb-0">
                    Pengiriman Barang
                    @if ($tglAwal->format('mY') === $tglAkhir->format('mY'))
                        {{ $tglAwal->format('d') }} - {{ $tglAkhir->format('d M Y') }}
                    @else
                        {{ $tglAwal->format('d-m-Y') }} - {{ $tglAkhir->format('d-m-Y') }}
                    @endif
                </h5>

                <!-- Tombol Tambah (modal trigger) -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <i class="bx bx-plus"></i> Add
                </button>
            </div>

            <form action="{{ route('admin.barang.index', $pengiriman->id) }}" method="GET" class="d-flex"
                style="max-width: 300px;">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm me-2"
                    placeholder="Cari barang...">
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
                        <th>Pelanggan</th>
                        <th>Area</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($barangs as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->pelanggan->nama ?? '-' }}</td>
                            <td>{{ $barang->pelanggan->area->nama_area ?? '-' }}</td>
                            <td>{{ strtoupper($barang->kategori) }}</td>
                            <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                            <td>
                                <span
                                    class="badge bg-label-{{ $barang->status == 'selesai' ? 'success' : ($barang->status == 'tertunda' ? 'warning' : 'info') }}">
                                    {{ ucfirst($barang->status) }}
                                </span>
                            </td>

                            <td>{{ $barang->catatan ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Edit -->
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $barang->id }}">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.barang.destroy', [$pengiriman->id, $barang->id]) }}"
                                        method="POST" onsubmit="return confirm('Yakin hapus barang ini?')"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data barang</td>
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
            <form action="{{ route('admin.barang.store', $pengiriman->id) }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Pelanggan</label>
                        <select name="pelanggan_id" class="form-select" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach (\App\Models\Pelanggan::with('area')->get() as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}
                                    ({{ $p->area->nama_area ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="cod">COD</option>
                            <option value="non-cod">Non COD</option>
                            <option value="order">Order</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    @foreach ($pengiriman->barangs as $barang)
        <div class="modal fade" id="editModal{{ $barang->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.barang.update', [$pengiriman->id, $barang->id]) }}" method="POST"
                    class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Pelanggan</label>
                            <select name="pelanggan_id" class="form-select" required>
                                @foreach (\App\Models\Pelanggan::with('area')->get() as $p)
                                    <option value="{{ $p->id }}"
                                        {{ $barang->pelanggan_id == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama }} ({{ $p->area->nama_area ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="cod" {{ $barang->kategori == 'cod' ? 'selected' : '' }}>COD</option>
                                <option value="non-cod" {{ $barang->kategori == 'non-cod' ? 'selected' : '' }}>Non COD
                                </option>
                                <option value="order" {{ $barang->kategori == 'order' ? 'selected' : '' }}>Order</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control" value="{{ $barang->harga }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="proses" {{ $barang->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="tertunda" {{ $barang->status == 'tertunda' ? 'selected' : '' }}>Tertunda
                                </option>
                                <option value="selesai" {{ $barang->status == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control" rows="2">{{ $barang->catatan }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
