<?php

namespace App\Http\Controllers\kurir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Pengiriman;

class PengirimanController extends Controller
{
    /**
     * Tampilkan daftar pengiriman kurir
     */
    public function index(Request $request)
    {
        $kurir = Auth::user();
        $areaId = $kurir->area->id ?? null;

        if (!$areaId) {
            return redirect()->back()->withErrors(['area' => 'Anda belum memiliki area yang ditugaskan.']);
        }

        $today = now()->toDateString();

        // Ambil pengiriman yang aktif hari ini (berdasarkan periode keberangkatan–distribusi)
        $pengirimanAktif = Pengiriman::whereDate('tanggal_keberangkatan', '<=', $today)
            ->where(function ($q) use ($today) {
                $q->whereDate('tanggal_distribusi', '>=', $today)
                    ->orWhereNull('tanggal_distribusi');
            })
            ->orderByDesc('tanggal_keberangkatan')
            ->first();

        if ($pengirimanAktif) {
            // Kalau ada pengiriman aktif → ambil data barang
            $query = Barang::where('pengiriman_id', $pengirimanAktif->id)
                ->whereHas('pelanggan', function ($q) use ($areaId) {
                    $q->where('area_id', $areaId);
                })
                ->with(['pelanggan', 'pengiriman']);

            // Filter pencarian
            if ($request->filled('q')) {
                $search = $request->q;
                $query->where(function ($q) use ($search) {
                    $q->whereHas('pelanggan', function ($q2) use ($search) {
                        $q2->where('nama', 'like', "%{$search}%")
                            ->orWhere('alamat', 'like', "%{$search}%");
                    })
                        ->orWhere('kategori', 'like', "%{$search}%");
                });
            }

            $barangs = $query->get();
            $tanggalKeberangkatan = $pengirimanAktif->tanggal_keberangkatan;
            $tanggalDistribusi    = $pengirimanAktif->tanggal_distribusi;
        } else {
            // Kalau tidak ada pengiriman aktif → kosongkan data
            $barangs = collect();
            $tanggalKeberangkatan = null;
            $tanggalDistribusi    = null;
        }

        return view('kurir.pengiriman.index', compact(
            'barangs',
            'tanggalKeberangkatan',
            'tanggalDistribusi',
            'pengirimanAktif'
        ));
    }



    public function updateStatus(Request $request, Barang $barang)
    {
        $request->validate([
            'status' => 'required|in:proses,tertunda,selesai',
            'catatan' => 'nullable|string|max:255',
        ]);

        $barang->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        // Update status pengiriman otomatis
        $pengiriman = $barang->pengiriman;
        $totalBelumSelesai = $pengiriman->barangs()->where('status', '!=', 'selesai')->count();

        if ($totalBelumSelesai === 0) {
            $pengiriman->update(['status' => 'selesai']);
        } else {
            if ($pengiriman->status === 'selesai') {
                $pengiriman->update(['status' => 'proses']);
            }
        }

        return back()->with('success', 'Status barang berhasil diperbarui.');
    }

    public function riwayat(Request $request)
    {
        $kurir = Auth::user();
        $areaId = $kurir->area->id ?? null;

        if (!$areaId) {
            return redirect()->back()->withErrors(['area' => 'Anda belum memiliki area yang ditugaskan.']);
        }

        $today = now()->toDateString();

        // Ambil semua periode pengiriman yang sudah didistribusikan SEBELUM hari ini
        $riwayatPengiriman = Pengiriman::whereNotNull('tanggal_distribusi')
            ->whereDate('tanggal_distribusi', '<', $today)
            ->orderByDesc('tanggal_keberangkatan')
            ->get();

        // Ambil list tanggal (format Y-m-d) untuk dropdown filter, unique & reindex
        $tanggalList = $riwayatPengiriman
            ->pluck('tanggal_keberangkatan')
            ->map(function ($d) {
                return \Carbon\Carbon::parse($d)->toDateString();
            })
            ->unique()
            ->values();

        // Tentukan tanggal dipilih: prioritas dari request, lalu fallback ke pertama di list
        $requestedTanggal = $request->get('tanggal');

        if ($requestedTanggal) {
            // coba parse request, kalau gagal fallback ke first()
            try {
                $tanggalDipilih = \Carbon\Carbon::parse($requestedTanggal)->toDateString();
            } catch (\Exception $e) {
                $tanggalDipilih = $tanggalList->first();
            }
        } else {
            $tanggalDipilih = $tanggalList->first();
        }

        // Ambil data barang sesuai tanggal yang dipilih (jika ada)
        if ($tanggalDipilih) {
            $barangs = Barang::whereHas('pengiriman', function ($q) use ($tanggalDipilih) {
                $q->whereDate('tanggal_keberangkatan', $tanggalDipilih);
            })
                ->whereHas('pelanggan', function ($q) use ($areaId) {
                    $q->where('area_id', $areaId);
                })
                ->with(['pelanggan', 'pengiriman'])
                ->get();
        } else {
            // tidak ada riwayat --> kosongkan
            $barangs = collect();
        }

        return view('kurir.pengiriman.riwayat', compact(
            'riwayatPengiriman',
            'tanggalList',
            'tanggalDipilih',
            'barangs'
        ));
    }
}
