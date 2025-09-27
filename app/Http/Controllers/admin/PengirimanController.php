<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PengirimanController extends Controller
{
    public function index()
    {
        $pengirimans = Pengiriman::withCount('barangs')
            ->withSum('barangs', 'harga')
            ->latest()
            ->get();

        return view('admin.pengiriman.index', compact('pengirimans'));
    }


    public function create()
    {
        return view('admin.pengiriman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_distribusi'    => 'nullable|date|after_or_equal:tanggal_keberangkatan',
        ]);

        Pengiriman::create($request->only('tanggal_keberangkatan', 'tanggal_distribusi'));

        return redirect()->route('admin.pengiriman.index')->with('success', 'Pengiriman berhasil ditambahkan.');
    }

    public function show(Pengiriman $pengiriman)
    {
        $pengiriman->load('barangs.pelanggan');
        return view('admin.pengiriman.show', compact('pengiriman'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_distribusi'    => 'nullable|date|after_or_equal:tanggal_keberangkatan',
            'status'                => 'required|in:proses,selesai,tertunda',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->update($request->all());

        return redirect()->route('admin.pengiriman.index')->with('success', 'Pengiriman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->delete();

        return redirect()->route('admin.pengiriman.index')->with('success', 'Pengiriman berhasil dihapus.');
    }


    public function pdf($id)
    {
        $pengiriman = Pengiriman::with(['barangs.pelanggan.area'])->findOrFail($id);

        if ($pengiriman->barangs->isEmpty()) {
            return back()->with('error', 'Tidak ada barang pada pengiriman ini.');
        }

        $grouped = $pengiriman->barangs->groupBy(function ($barang) {
            return $barang->pelanggan->area->nama_area ?? 'Tanpa Area';
        });

        $laporan = [];
        foreach ($grouped as $area => $barangs) {
            $laporan[$area] = [
                'tanggal' => $pengiriman->tanggal_keberangkatan->format('d-m-Y'),
                'items' => $barangs->map(function ($barang, $index) {
                    return [
                        'no' => $index + 1,
                        'nama' => $barang->pelanggan->nama,
                        'kategori' => strtoupper($barang->kategori),
                        'harga' => $barang->harga,
                    ];
                }),
                'total' => $barangs->sum('harga'),
            ];
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pengiriman.pdf', [
            'pengiriman' => $pengiriman,
            'laporan' => $laporan,
        ])->setPaper('a4', 'portrait');

        return $pdf->download("JPB_Express_{$pengiriman->tanggal_keberangkatan->format('d-m-Y')}.pdf");
        // kalau mau langsung download -> pakai ->download()
    }
}
