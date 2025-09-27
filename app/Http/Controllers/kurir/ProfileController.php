<?php

namespace App\Http\Controllers\kurir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('kurir.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = \App\Models\User::findOrFail(Auth::id());

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'telpon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'motto'  => 'nullable|string|max:255',
        ]);

        $data = $request->only(['name', 'email', 'telpon', 'alamat', 'motto']);

        // Simpan update pakai update()
        $user->update($data);

        return redirect()->route('kurir.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateFoto(Request $request)
    {
        $user = \App\Models\User::findOrFail(Auth::id());

        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:800',
        ]);

        if ($user->foto && Storage::exists('public/foto_user/' . $user->foto)) {
            Storage::delete('public/foto_user/' . $user->foto);
        }

        $filename = time() . '.' . $request->foto->extension();
        $request->foto->move(storage_path('app/public/foto_user'), $filename);

        $user->update(['foto' => $filename]);

        return back()->with('success', 'Foto berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = \App\Models\User::findOrFail(Auth::id());

        $request->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|string|min:8|confirmed',
        ]);

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
