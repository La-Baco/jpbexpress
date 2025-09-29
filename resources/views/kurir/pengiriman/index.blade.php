@extends('layouts.app')

@section('title', 'Pengiriman Saya')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kurir /</span> Pengiriman Saya</h4>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

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
        <div
            class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            {{-- Tampilkan tanggal pengiriman --}}
            @php
                $firstDate = $barangs->pluck('pengiriman.tanggal_keberangkatan')->min();
                $lastDate = $barangs->pluck('pengiriman.tanggal_distribusi')->max();
            @endphp
            <h5 class="mb-0">
                Pengiriman:
                {{ $firstDate ? \Carbon\Carbon::parse($firstDate)->format('d') : '-' }}-
                {{ $lastDate ? \Carbon\Carbon::parse($lastDate)->format('d M Y') : '-' }}
            </h5>

            {{-- Form pencarian --}}
            <form action="{{ route('kurir.pengiriman.index') }}" method="GET" class="d-flex" style="max-width: 400px;">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm me-2"
                    placeholder="Cari pelanggan, alamat, atau kategori...">
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
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($barangs as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->pelanggan->nama }}</td>
                            <td>{{ $b->pelanggan->alamat }}</td>
                            <td>{{ $b->pelanggan->telpon }}</td>
                            <td>{{ strtoupper($b->kategori) }}</td>
                            <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                            <td>
                                <span
                                    class="badge bg-label-{{ $b->status == 'selesai' ? 'success' : ($b->status == 'tertunda' ? 'warning' : 'primary') }}">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            <td>{{ $b->catatan ?? '-' }}</td>
                            <td>
                                <form action="{{ route('kurir.pengiriman.updateStatus', $b->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @php
                                        $nextStatus = $b->status === 'selesai' ? 'tertunda' : 'selesai';
                                        $btnClass = $b->status === 'selesai' ? 'btn-danger' : 'btn-success';
                                        $btnIcon = $b->status === 'selesai' ? '✖' : '✔';
                                    @endphp
                                    <input type="hidden" name="status" value="{{ $nextStatus }}">
                                    <button type="submit" class="btn btn-sm {{ $btnClass }}"
                                        title="{{ $b->status === 'selesai' ? 'Batalkan' : 'Selesai' }}">
                                        {{ $btnIcon }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                Tidak ada pengiriman hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
