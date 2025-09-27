@extends('layouts.app')

@section('title', 'Pengiriman')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Pengiriman</h4>

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
        <div class="card-header d-flex justify-content-between align-items-center mb-1">
            <h5 class="mb-0">Pengiriman</h5>

            <!-- Tombol Tambah (modal trigger) -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="bx bx-plus"></i> Add
            </button>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keberangkatan</th>
                        <th>Distribusi</th>
                        <th>Status</th>
                        <th>Jumlah Barang</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($pengirimans as $index => $pengiriman)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pengiriman->tanggal_keberangkatan->format('d M Y') }}</td>
                            <td>{{ $pengiriman->tanggal_distribusi ? $pengiriman->tanggal_distribusi->format('d M Y') : '-' }}
                            </td>
                            <td>
                                <span
                                    class="badge bg-label-{{ $pengiriman->status == 'selesai' ? 'success' : ($pengiriman->status == 'tertunda' ? 'warning' : 'info') }}">
                                    {{ ucfirst($pengiriman->status) }}
                                </span>
                            </td>
                            <td>{{ $pengiriman->barangs_count }}</td>
                            <td>Rp {{ number_format($pengiriman->barangs_sum_harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex gap-2">

                                    <a href="{{ route('admin.pengiriman.pdf', $pengiriman->id) }}"
                                        class="btn btn-sm btn-success" title="Download PDF">
                                        <i class="bx bx-download"></i>
                                    </a>

                                    <!-- Detail Barang -->
                                    <a href="{{ route('admin.barang.index', $pengiriman->id) }}"
                                        class="btn btn-sm btn-info" title="Detail Barang">
                                        <i class="bx bx-package"></i>
                                    </a>

                                    <!-- Edit -->
                                    <button type="button" class="btn btn-sm btn-warning" title="Edit"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $pengiriman->id }}">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.pengiriman.destroy', $pengiriman->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus pengiriman ini?')" style="display:inline;">
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
                            <td colspan="7" class="text-center">Belum ada data pengiriman</td>
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
            <form action="{{ route('admin.pengiriman.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Tanggal Keberangkatan</label>
                        <input type="date" name="tanggal_keberangkatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Distribusi</label>
                        <input type="date" name="tanggal_distribusi" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select" required>
                            <option value="proses">Proses</option>
                            <option value="tertunda">Tertunda</option>
                            <option value="selesai">Selesai</option>
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
    @foreach ($pengirimans as $pengiriman)
        <div class="modal fade" id="editModal{{ $pengiriman->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.pengiriman.update', $pengiriman->id) }}" method="POST"
                    class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pengiriman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Tanggal Keberangkatan</label>
                            <input type="date" name="tanggal_keberangkatan" class="form-control"
                                value="{{ $pengiriman->tanggal_keberangkatan->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Distribusi</label>
                            <input type="date" name="tanggal_distribusi" class="form-control"
                                value="{{ $pengiriman->tanggal_distribusi ? $pengiriman->tanggal_distribusi->format('Y-m-d') : '' }}">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="proses" {{ $pengiriman->status == 'proses' ? 'selected' : '' }}>Proses
                                </option>
                                <option value="tertunda" {{ $pengiriman->status == 'tertunda' ? 'selected' : '' }}>
                                    Tertunda</option>
                                <option value="selesai" {{ $pengiriman->status == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
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
@endsection
