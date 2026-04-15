<?php

namespace App\Http\Controllers\KepalaPerpus;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunKepalaPerpusController extends Controller
{
    public function create(){
        return view('page.kepalaperpus.akun.create');
    }

    public function store(Request $request){
        $request->validate([
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'          => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nip'           => 'required|string|max:50|unique:users,nip',
            'password'      => 'required|string|min:4',
        ]);

        $datakepalaperpus_store = [
        'name'   => $request->name,
        'email'  => $request->email,
        'nip'    => $request->nip,
        'password' => Hash::make($request->password)
        ];

        // upload foto
        if ($request->hasFile('foto')) {
            $datakepalaperpus_store['foto'] = $request->file('foto')->store('imgkepalaperpus', 'public');
        }

        User::create($datakepalaperpus_store);

        return redirect()->route('dashboard.index')->with('success', 'Akun Kepala Perpustakaan berhasil ditambahkan');
    }
}
