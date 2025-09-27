<?php

namespace App\Http\Controllers\admin;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('kurir')->latest()->get();
        $kurirs = User::where('role', 'kurir')->get();
        return view('admin.area.index', compact('areas', 'kurirs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'user_id'   => 'nullable|exists:users,id'
        ]);

        Area::create([
            'nama_area' => $request->nama_area,
            'user_id'   => $request->user_id,
        ]);

        return redirect()->route('admin.area.index')->with('success', 'Area berhasil ditambahkan.');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'user_id'   => 'nullable|exists:users,id',
        ]);

        $area = Area::findOrFail($id);
        $area->update([
            'nama_area' => $request->nama_area,
            'user_id'   => $request->user_id,
        ]);

        return redirect()->route('admin.area.index')->with('success', 'Area berhasil diupdate.');
    }


    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return redirect()->route('admin.area.index')->with('success', 'Area berhasil dihapus.');
    }
}
