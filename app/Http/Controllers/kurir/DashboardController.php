<?php

namespace App\Http\Controllers\kurir;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pengiriman;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $kurirId = Auth::id();
        $today   = Carbon::today();

        // Ambil pengiriman terbaru yang sudah dimulai
        $latestPengiriman = Pengiriman::whereDate('tanggal_keberangkatan', '<=', $today)
            ->orderBy('tanggal_keberangkatan', 'desc')
            ->first();

        // Ambil pengiriman sebelumnya (sebelum latest)
        $previousPengiriman = null;
        if ($latestPengiriman) {
            $previousPengiriman = Pengiriman::whereDate('tanggal_keberangkatan', '<', $latestPengiriman->tanggal_keberangkatan)
                ->orderBy('tanggal_keberangkatan', 'desc')
                ->first();
        }

        // Data periode terbaru
        $totalBarang = $selesai = $proses = $tertunda = $totalHarga = 0;

        if ($latestPengiriman) {
            $barangQuery = Barang::where('pengiriman_id', $latestPengiriman->id)
                ->whereHas('pelanggan.area', function ($q) use ($kurirId) {
                    $q->where('user_id', $kurirId);
                });

            $totalBarang = (clone $barangQuery)->count();
            $selesai     = (clone $barangQuery)->where('status', 'selesai')->count();
            $tertunda    = (clone $barangQuery)->where('status', 'tertunda')->count();
            $proses      = (clone $barangQuery)->where('status', 'proses')->count();
            $totalHarga  = (clone $barangQuery)->sum('harga');
        }

        // Data periode sebelumnya
        $totalBarangSebelumnya = $selesaiSebelumnya = $prosesSebelumnya = $tertundaSebelumnya = $totalHargaSebelumnya = 0;

        if ($previousPengiriman) {
            $barangPrevQuery = Barang::where('pengiriman_id', $previousPengiriman->id)
                ->whereHas('pelanggan.area', function ($q) use ($kurirId) {
                    $q->where('user_id', $kurirId);
                });

            $totalBarangSebelumnya = (clone $barangPrevQuery)->count();
            $selesaiSebelumnya     = (clone $barangPrevQuery)->where('status', 'selesai')->count();
            $tertundaSebelumnya    = (clone $barangPrevQuery)->where('status', 'tertunda')->count();
            $prosesSebelumnya      = (clone $barangPrevQuery)->where('status', 'proses')->count();
            $totalHargaSebelumnya  = (clone $barangPrevQuery)->sum('harga');
        }

        return view('kurir.dashboard', compact(
            'latestPengiriman',
            'previousPengiriman',

            // periode terbaru
            'totalBarang',
            'selesai',
            'tertunda',
            'proses',
            'totalHarga',

            // periode sebelumnya
            'totalBarangSebelumnya',
            'selesaiSebelumnya',
            'tertundaSebelumnya',
            'prosesSebelumnya',
            'totalHargaSebelumnya'
        ));
    }
}
