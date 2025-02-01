<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PenggunaanController extends Controller
{
   public function index()
{
    // Mengambil data penggunaan dengan paginasi
    $penggunaans = Penggunaan::with('pelanggan')->paginate(10); // 10 data per halaman

    return view('penggunaans.index', compact('penggunaans'));
}

    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('penggunaans.create', compact('pelanggans'));
    }
  public function getMeterAwal($nomor_kwh)
{
    $pelanggan = Pelanggan::where('nomor_kwh', $nomor_kwh)->first();

    if (!$pelanggan) {
        return response()->json(['error' => 'Nomor KWH tidak ditemukan'], 404);
    }

    $penggunaanTerakhir = Penggunaan::where('id_pelanggan', $pelanggan->id)
        ->orderBy('created_at', 'desc')
        ->first();

    $meterAwal = $penggunaanTerakhir ? $penggunaanTerakhir->meter_akhir : 0;

    return response()->json([
        'meter_awal' => $meterAwal,
        'id_pelanggan' => $pelanggan->id,
    ]);
}


public function getBulan($nomor_kwh)
{
    // Cari pelanggan berdasarkan nomor KWH
    $pelanggan = Pelanggan::where('nomor_kwh', $nomor_kwh)->first();

    if (!$pelanggan) {
        return response()->json(['error' => 'Nomor KWH tidak ditemukan'], 404);
    }

    // Ambil penggunaan terakhir pelanggan
    $penggunaanTerakhir = Penggunaan::where('id_pelanggan', $pelanggan->id)
        ->orderBy('tahun', 'desc')
        ->orderBy('bulan', 'desc')
        ->first();

    // Hitung bulan berikutnya
    $bulan = $penggunaanTerakhir ? ($penggunaanTerakhir->bulan % 12) + 1 : 1;

    return response()->json([
        'bulan' => $bulan
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'meter_awal' => 'required|integer',
            'meter_akhir' => 'required|integer|gte:meter_awal',
        ]);
        Penggunaan::create([
            'id' => Str::uuid(),
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'meter_awal' => $request->meter_awal,
            'meter_akhir' => $request->meter_akhir,
        ]);

        return redirect()->route('penggunaans.index')->with('success', 'Penggunaan berhasil ditambahkan');
    }

  public function edit($id)
{
    // Ambil data penggunaan berdasarkan ID
    $penggunaan = Penggunaan::with('pelanggan')->findOrFail($id);

    // Ambil daftar pelanggan untuk dropdown Nomor KWH
    $pelanggans = Pelanggan::select('nomor_kwh', 'id')->get();

    return view('penggunaans.edit', compact('penggunaan', 'pelanggans'));
}

   public function update(Request $request, $id)
{

    $request->validate([
        'nomor_kwh' => 'required|exists:pelanggans,nomor_kwh',
        'bulan' => 'required|integer|min:1|max:12',
        'tahun' => 'required|integer',
        'meter_awal' => 'required|integer|min:0',
        'meter_akhir' => 'required|integer|gte:meter_awal',
    ]);

    // Cari pelanggan berdasarkan nomor KWH
    $pelanggan = Pelanggan::where('nomor_kwh', $request->nomor_kwh)->first();

    if (!$pelanggan) {
        return redirect()->back()->withErrors(['nomor_kwh' => 'Nomor KWH tidak ditemukan']);
    }

    // Update data penggunaan
    $penggunaan = Penggunaan::findOrFail($id);

    $penggunaan->update([
        'id_pelanggan' => $pelanggan->id,
        'bulan' => $request->bulan,
        'tahun' => $request->tahun,
        'meter_awal' => $request->meter_awal,
        'meter_akhir' => $request->meter_akhir,
    ]);


    return redirect()->route('penggunaans.index')->with('success', 'Penggunaan berhasil diperbarui!');
}

    public function destroy(Penggunaan $penggunaan)
    {
        $penggunaan->delete();

        return redirect()->route('penggunaans.index')->with('success', 'Penggunaan berhasil dihapus');
    }
}
