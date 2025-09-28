<?php

namespace App\Http\Controllers\admin;

use App\Models\Area;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Imports\PelangganImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelanggan::with('area');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->q}%")
                    ->orWhere('telpon', 'like', "%{$request->q}%")
                    ->orWhere('alamat', 'like', "%{$request->q}%");
            });
        }

        $pelanggan = $query->get();

        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('admin.pelanggan.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telpon' => 'required|string|max:15',
            'area_id' => 'required|exists:areas,id',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }


    public function edit(Pelanggan $id)
    {
        $areas = Area::all();
        return view('admin.pelanggan.edit', compact('pelanggan', 'areas'));
    }

    public function update(Request $request, Pelanggan $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telpon' => 'required|string|max:15',
            'area_id' => 'required|exists:areas,id',
        ]);

        $id->update($request->all());

        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui');
    }

    public function destroy(Pelanggan $id)
    {
        $id->delete();
        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new PelangganImport, $request->file('file'));

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil diimport.');
    }
}
