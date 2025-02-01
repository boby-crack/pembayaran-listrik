<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;
 use Illuminate\Support\Str; // Tambahkan use Str di bagian atas file
  use Illuminate\Support\Facades\Hash; // Pastikan ini ditambahkan di bagian atas



class PelangganController extends Controller
{

public function index()
{
    // Mengambil data pelanggan dengan paginasi
    $pelanggans = Pelanggan::with('tarif')->paginate(10); // 10 data per halaman

    return view('pelanggans.index', compact('pelanggans'));
}


    public function create()
    {
        $tarifs = Tarif::all();
        return view('pelanggans.create', compact('tarifs'));
    }


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6',
        'nomor_kwh' => 'required|string|max:255',
        'nomor_hp' => 'required|string|max:15',
        'alamat' => 'required|string|max:255',
        'id_tarif' => 'required|exists:tarifs,id',
    ]);

    $pelanggan = Pelanggan::create([
        'id' => Str::uuid(), // Generate UUID untuk id
        'name' => $request->name,
        'password' => bcrypt($request->password),
        'nomor_kwh' => $request->nomor_kwh,
        'nomor_hp' => $request->nomor_hp,
        'alamat' => $request->alamat,
        'id_tarif' => $request->id_tarif,
    ]);

    return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan');
}



    public function edit(Pelanggan $pelanggan)
    {
        $tarifs = Tarif::all();
        return view('pelanggans.edit', compact('pelanggan', 'tarifs'));
    }


public function update(Request $request, Pelanggan $pelanggan)
{
    // Validasi Input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:6', // Password opsional
        'nomor_kwh' => 'required|string|max:255',
        'nomor_hp' => 'required|string|max:15',
        'alamat' => 'required|string|max:255',
        'id_tarif' => 'required|exists:tarifs,id',
    ]);

    // Jika password diisi, update password
    if ($request->filled('password')) {
        $validated['password'] = Hash::make($request->password);
    } else {
        // Jika password tidak diisi, hapus dari array validasi agar tidak diperbarui
        unset($validated['password']);
    }

    // Update Data Pelanggan
    $pelanggan->update($validated);

    // Redirect kembali ke halaman index dengan pesan sukses
    return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil diperbarui');
}




    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}
