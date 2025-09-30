<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\Pelanggan;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

        $pengirimanHariIni = Pengiriman::where('tanggal_keberangkatan', '<=', $today)
            ->where(function ($q) use ($today) {
                $q->where('tanggal_distribusi', '>=', $today)
                    ->orWhereNull('tanggal_distribusi');
            })
            ->orderBy('tanggal_keberangkatan', 'desc')
            ->first();

        // default nilai
        $pelanggan = null;
        $pengirimanAktif = null;
        $jumlahBarang = 0;
        $barangs = collect();

        // kalau ada session hasil tracking
        if (session('pelanggan_id') && session('pengiriman_id')) {
            $pelanggan = Pelanggan::find(session('pelanggan_id'));
            $pengirimanAktif = Pengiriman::find(session('pengiriman_id'));

            if ($pelanggan && $pengirimanAktif) {
                $barangs = $pelanggan->barangs()
                    ->where('pengiriman_id', $pengirimanAktif->id)
                    ->get();

                $jumlahBarang = $barangs->count();
            }
        }

        return view('home', [
            'pelanggan' => $pelanggan,
            'pengirimanAktif' => $pengirimanAktif,
            'jumlahBarang' => $jumlahBarang,
            'barangs' => $barangs,
            'pengirimanHariIni' => $pengirimanHariIni,
        ]);
    }

    public function tracking(Request $request)
    {
        $request->validate([
            'kode_tracking' => 'required|string'
        ]);

        if (!preg_match('/^JPB-\d{4}$/', $request->kode_tracking)) {
            return redirect('/#pengiriman')->with('error', 'Format kode tracking salah. Gunakan JPB-1234');
        }

        $last4 = substr($request->kode_tracking, -4);

        $pelanggan = Pelanggan::whereRaw('RIGHT(telpon, 4) = ?', [$last4])->first();

        if (!$pelanggan) {
            return redirect('/#pengiriman')->with('error', 'Kode tracking tidak ditemukan.');
        }

        $today = Carbon::today()->toDateString();

        $pengirimanAktif = Pengiriman::where('tanggal_keberangkatan', '<=', $today)
            ->where(function ($q) use ($today) {
                $q->where('tanggal_distribusi', '>=', $today)
                    ->orWhereNull('tanggal_distribusi');
            })
            ->orderBy('tanggal_keberangkatan', 'desc')
            ->first();

        if (!$pengirimanAktif) {
            return redirect('/#pengiriman')->with('error', 'Tidak ada pengiriman untuk periode hari ini.');
        }

        // simpan ID saja, supaya bisa dipakai di index()
        return redirect('/#pengiriman')->with([
            'pelanggan_id'   => $pelanggan->id,
            'pengiriman_id'  => $pengirimanAktif->id,
        ]);
    }
}
