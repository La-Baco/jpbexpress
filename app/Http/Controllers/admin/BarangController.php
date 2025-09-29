<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request, Pengiriman $pengiriman)
    {
        $query = $pengiriman->barangs()->with('pelanggan.area');

        // Search by pelanggan.nama, area.nama_area, atau kategori
        if ($request->filled('q')) {
            $q = $request->q;
            $query->whereHas('pelanggan', function ($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('alamat', 'like', "%$q%");
            })->orWhere('kategori', 'like', "%$q%");
        }

        $barangs = $query->latest()->get();

        return view('admin.barang.index', compact('pengiriman', 'barangs'));
    }

    public function store(Request $request, Pengiriman $pengiriman)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'kategori'     => 'required|in:cod,non-cod,order',
            'harga'        => 'required|numeric|min:0',
            'catatan'      => 'nullable|string',
        ]);

        $pengiriman->barangs()->create($request->only(
            'pelanggan_id',
            'kategori',
            'harga',
            'catatan'
        ));

        return redirect()->route('admin.barang.index', $pengiriman->id)
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request, Pengiriman $pengiriman, Barang $barang)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'kategori'     => 'required|in:cod,non-cod,order',
            'harga'        => 'required|numeric|min:0',
            'status'       => 'required|in:proses,tertunda,selesai',
            'catatan'      => 'nullable|string',
        ]);

        $barang->update($request->only(
            'pelanggan_id',
            'kategori',
            'harga',
            'status',
            'catatan'
        ));

        return redirect()->route('admin.barang.index', $pengiriman->id)
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Pengiriman $pengiriman, Barang $barang)
    {
        $barang->delete();

        return redirect()->route('admin.barang.index', $pengiriman->id)
            ->with('success', 'Barang berhasil dihapus.');
    }
}
