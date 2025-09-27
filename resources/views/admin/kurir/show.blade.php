@extends('layouts.app')

@section('title', 'Show Kurir')

@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kurir /</span> Show-Profile</h4>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Foto -->
                        <div class="col-12 col-md-4 text-center">
                            @if ($kurir->foto && file_exists(public_path('storage/foto_user/' . $kurir->foto)))
                                <img src="{{ asset('storage/foto_user/' . $kurir->foto) }}" alt="Foto {{ $kurir->name }}"
                                    class="img-fluid mb-3"
                                    style="width:180px; height:180px; object-fit: cover; border-radius:8px;">
                            @else
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="No Photo" class="img-fluid mb-3"
                                    style="width:180px; height:180px; object-fit: cover; border-radius:8px;">
                            @endif
                            <h5 class="mt-2">{{ $kurir->name }}</h5>
                            <p class="text-muted">{{ $kurir->email }}</p>
                        </div>

                        <!-- Data diri -->
                        <div class="col-12 col-md-8">
                            <div class="card p-3 shadow-sm">
                                <div class="row g-3">
                                    <!-- Telpon -->
                                    <div class="col-12 col-sm-6">
                                        <div class="d-flex justify-content-between align-items-start p-2 border rounded">
                                            <span class="fw-bold me-2">Telpon:</span>
                                            <span class="text-truncate"
                                                style="max-width: 150px;">{{ $kurir->telpon ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="col-12 col-sm-6">
                                        <div
                                            class="d-flex justify-content-between align-items-start p-2 border rounded flex-wrap">
                                            <span class="fw-bold me-2">Alamat:</span>
                                            <span class="text-break">{{ $kurir->alamat ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <!-- Motto -->
                                    <div class="col-12 col-sm-6">
                                        <div
                                            class="d-flex justify-content-between align-items-start p-2 border rounded flex-wrap">
                                            <span class="fw-bold me-2">Motto:</span>
                                            <span class="text-break">{{ $kurir->motto ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <!-- Role -->
                                    <div class="col-12 col-sm-6">
                                        <div class="d-flex justify-content-between align-items-start p-2 border rounded">
                                            <span class="fw-bold me-2">Jabatan:</span>
                                            <span>{{ $kurir->role }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- row g-4 -->
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div>
    </div>

@endsection
