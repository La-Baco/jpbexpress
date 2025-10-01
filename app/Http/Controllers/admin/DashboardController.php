<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pengiriman;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

        // 1. Total keseluruhan pelanggan
        $totalPelanggan = Pelanggan::count();

        // 2. Total kurir
        $totalKurir = User::where('role', 'kurir')->count();

        // 3. Ambil pengiriman AKTIF sesuai periode hari ini
        $latestPengiriman = Pengiriman::where('tanggal_keberangkatan', '<=', $today)
            ->where(function ($q) use ($today) {
                $q->where('tanggal_distribusi', '>=', $today)
                    ->orWhereNull('tanggal_distribusi');
            })
            ->orderBy('tanggal_keberangkatan', 'desc')
            ->first();

        $latestPengirimanId = $latestPengiriman?->id;

        // Ambil pengiriman sebelumnya (periode sebelum latest)
        $previousPengiriman = null;
        if ($latestPengiriman) {
            $previousPengiriman = Pengiriman::where('tanggal_keberangkatan', '<', $latestPengiriman->tanggal_keberangkatan)
                ->orderBy('tanggal_keberangkatan', 'desc')
                ->first();
        }

        // Statistik status pengiriman terbaru
        $pengirimanStats = [
            'proses' => 0,
            'selesai' => 0,
            'tertunda' => 0,
        ];

        if ($latestPengiriman) {
            $pengirimanStats[$latestPengiriman->status] = 1;
        }

        // 4. Total barang di pengiriman terbaru
        $totalBarangLatest = $latestPengirimanId
            ? Barang::where('pengiriman_id', $latestPengirimanId)->count()
            : 0;

        // Hitung barang pengiriman sebelumnya
        $totalBarangPrevious = $previousPengiriman
            ? Barang::where('pengiriman_id', $previousPengiriman->id)->count()
            : 0;

        // Tren barang (positif = naik, negatif = turun)
        $barangTrend = $totalBarangLatest - $totalBarangPrevious;

        // 5. Total area
        $totalArea = Area::count();

        // 6. Statistik barang per area di pengiriman terbaru
        $areaStats = collect();
        if ($latestPengirimanId) {
            $areaStats = Barang::where('pengiriman_id', $latestPengirimanId)
                ->join('pelanggans', 'barangs.pelanggan_id', '=', 'pelanggans.id')
                ->join('areas', 'pelanggans.area_id', '=', 'areas.id')
                ->select(
                    'areas.nama_area as area',
                    DB::raw('COUNT(barangs.id) as total_barang'),
                    DB::raw('SUM(barangs.harga) as total_harga')
                )
                ->groupBy('areas.id', 'areas.nama_area')
                ->get();
        }

        // 7. Pendapatan keseluruhan & pengiriman terbaru
        $pendapatanKeseluruhan = Barang::sum('harga');
        $pendapatanLatest = $latestPengirimanId
            ? Barang::where('pengiriman_id', $latestPengirimanId)->sum('harga')
            : 0;

        // Grafik pendapatan per pengiriman
        $grafikPendapatan = Pengiriman::where('tanggal_keberangkatan', '<=', $today)
            ->orderBy('tanggal_keberangkatan')
            ->withCount(['barangs as total_pendapatan' => function ($q) {
                $q->select(DB::raw('SUM(harga)'));
            }])
            ->get()
            ->map(function ($p) {
                return [
                    'tanggal' => Carbon::parse($p->tanggal_keberangkatan)->format('d M Y'),
                    'pendapatan' => $p->total_pendapatan ?? 0,
                ];
            });

        // 8. Kinerja kurir di pengiriman terbaru
        $kinerjaKurir = collect();

        if ($latestPengirimanId) {
            $kurirs = User::where('role', 'kurir')->get();

            $kinerjaKurir = $kurirs->map(function ($kurir) use ($latestPengirimanId) {
                $totalBarang = Barang::where('pengiriman_id', $latestPengirimanId)
                    ->whereHas('pelanggan.area', fn($q) => $q->where('user_id', $kurir->id))
                    ->count();

                $selesai = Barang::where('pengiriman_id', $latestPengirimanId)
                    ->whereHas('pelanggan.area', fn($q) => $q->where('user_id', $kurir->id))
                    ->where('status', 'selesai')
                    ->count();

                return [
                    'kurir' => $kurir->name,
                    'total_barang' => $totalBarang,
                    'selesai' => $selesai,
                    'proses' => $totalBarang - $selesai,
                ];
            });
        }

        return view('admin.dashboard', compact(
            'totalPelanggan',
            'totalKurir',
            'pengirimanStats',
            'totalBarangLatest',
            'barangTrend',
            'totalArea',
            'areaStats',
            'pendapatanKeseluruhan',
            'pendapatanLatest',
            'grafikPendapatan',
            'latestPengiriman',
            'totalBarangPrevious',
            'kinerjaKurir',
        ));
    }
}
