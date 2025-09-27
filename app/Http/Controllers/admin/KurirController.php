<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class KurirController extends Controller
{
    // Tampilkan daftar kurir
    public function index()
    {
        $kurirs = User::where('role', 'kurir')->latest()->get();
        return view('admin.kurir.index', compact('kurirs'));
    }

    // Tampilkan detail kurir
    public function show($id)
    {
        $kurir = User::findOrFail($id);

        if ($kurir->role !== 'kurir') {
            abort(404);
        }

        return view('admin.kurir.show', compact('kurir'));
    }

    // Tambah kurir baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'telpon'   => 'nullable|string|max:20',
            'alamat'   => 'nullable|string',
            // 'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // 'motto'    => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'kurir';

        // if ($request->hasFile('foto')) {
        //     $data['foto'] = $request->file('foto')->store('foto_user', 'public');
        // }

        User::create($data);

        return redirect()->route('admin.kurir.index')->with('success', 'Kurir berhasil ditambahkan.');
    }

    // Update data kurir
    public function update(Request $request, $id)
    {
        $kurir = User::findOrFail($id);

        if ($kurir->role !== 'kurir') {
            abort(404);
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $kurir->id,
            'password' => 'nullable|string|min:6|confirmed',
            'telpon'   => 'nullable|string|max:20',
            'alamat'   => 'nullable|string',
            // 'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // 'motto'    => 'nullable|string|max:255',
        ]);

        $data = $request->only(['name', 'email', 'telpon', 'alamat', 'motto']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // if ($request->hasFile('foto')) {
        //     $data['foto'] = $request->file('foto')->store('foto_user', 'public');
        // }

        $kurir->update($data);

        return redirect()->route('admin.kurir.index')->with('success', 'Data kurir berhasil diperbarui.');
    }

    // Hapus kurir
    public function destroy($id)
    {
        $kurir = User::findOrFail($id);

        if ($kurir->role !== 'kurir') {
            abort(404);
        }

        $kurir->delete();

        return redirect()->route('admin.kurir.index')->with('success', 'Kurir berhasil dihapus.');
    }
}
