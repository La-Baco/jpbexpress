<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\Barang;

class HomeController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        // Ambil pengiriman yang sedang berlangsung
        $pengirimans = Pengiriman::with(['barangs.pelanggan.area'])
            ->where('tanggal_keberangkatan', '<=', $today)
            ->where(function ($query) use ($today) {
                $query->where('tanggal_distribusi', '>=', $today)
                    ->orWhereNull('tanggal_distribusi');
            })
            ->get();

        $data = [];

        foreach ($pengirimans as $pengiriman) {
            foreach ($pengiriman->barangs as $barang) {
                $pelanggan = $barang->pelanggan;
                if (!$pelanggan) continue;

                // ambil nama area dari relasi area
                $area = $pelanggan->area ? $pelanggan->area->nama_area : 'Lainnya';
                $nama = $pelanggan->nama;

                if (!isset($data[$area])) {
                    $data[$area] = [];
                }

                if (!isset($data[$area][$nama])) {
                    $data[$area][$nama] = 0;
                }

                $data[$area][$nama] += 1; // jumlah barang per pelanggan
            }
        }

        return view('home', compact('data'));
    }
}
