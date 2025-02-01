<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Log;


class TagihanController extends Controller
{
    public function index()
    {
         $tagihans = Tagihan::with(['penggunaan.pelanggan'])->paginate(10);
    return view('tagihans.index', compact('tagihans'));
    }

    // Tampilkan Form Create
    public function create()
    {
        $pelanggans = Pelanggan::select('nomor_kwh', 'name')->get();
        return view('tagihans.create', compact('pelanggans'));
    }

    // Ambil Bulan & Tahun Berdasarkan Nomor KWH (AJAX)
    public function getBulanTahun($nomor_kwh)
{
    $pelanggan = Pelanggan::where('nomor_kwh', $nomor_kwh)->first();

    if (!$pelanggan) {
        return response()->json(['error' => 'Nomor KWH tidak ditemukan'], 404);
    }

    $bulanTahun = Penggunaan::where('id_pelanggan', $pelanggan->id)
        ->select('bulan', 'tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->orderBy('bulan', 'desc')
        ->get();

    if ($bulanTahun->isEmpty()) {
        return response()->json(['error' => 'Tidak ada data penggunaan untuk pelanggan ini'], 404);
    }

    return response()->json($bulanTahun);
}


    // Ambil Data Penggunaan Berdasarkan Bulan & Tahun (AJAX)
    public function getPenggunaan($nomor_kwh, $bulan, $tahun)
    {
        $pelanggan = Pelanggan::where('nomor_kwh', $nomor_kwh)->first();

        if (!$pelanggan) {
            return response()->json(['error' => 'Nomor KWH tidak ditemukan'], 404);
        }

        $penggunaan = Penggunaan::where('id_pelanggan', $pelanggan->id)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        if (!$penggunaan) {
            return response()->json(['error' => 'Data penggunaan tidak ditemukan'], 404);
        }

        return response()->json([
            'meter_awal' => $penggunaan->meter_awal,
            'meter_akhir' => $penggunaan->meter_akhir,
            'id_penggunaan' => $penggunaan->id,
        ]);
    }

    // Simpan Tagihan

public function store(Request $request)
{
    Log::info('Data Diterima:', $request->all());

    $request->validate([
        'nomor_kwh' => 'required|exists:pelanggans,nomor_kwh',
        'bulan' => 'required|string',
        'tahun' => 'required|integer',
        'id_penggunaan' => 'required|exists:penggunaans,id',
        'meter_awal' => 'required|integer',
        'meter_akhir' => 'required|integer|gte:meter_awal',
    ]);

    Log::info('Validasi Berhasil!');

    $pelanggan = Pelanggan::where('nomor_kwh', $request->nomor_kwh)->with('tarif')->first();

    $jumlahMeter = $request->meter_akhir - $request->meter_awal;
    $tarifPerKwh = $pelanggan->tarif->tarifperkwh ?? 1500;
    $totalTagihan = $jumlahMeter * $tarifPerKwh;

    Log::info('Jumlah Meter: ' . $jumlahMeter);
    Log::info('Total Tagihan: ' . $totalTagihan);

    Tagihan::create([
        'id' => Str::uuid(),
        'id_penggunaan' => $request->id_penggunaan,
        'id_pelanggan' => $pelanggan->id,
        'bulan' => $request->bulan,
        'tahun' => $request->tahun,
        'jumlah_meter' => $jumlahMeter,
        'total_tagihan' => $totalTagihan,
        'status' => 'belum lunas',
    ]);

    Log::info('Tagihan berhasil disimpan.');

    return redirect()->route('tagihans.index')->with('success', 'Tagihan berhasil dibuat!');
}




   public function edit($id)
{

    $tagihan = Tagihan::with('penggunaan', 'pelanggan')->findOrFail($id);
    $pelanggans = Pelanggan::select('nomor_kwh', 'name')->get();

    return view('tagihans.edit', compact('tagihan', 'pelanggans'));
}



public function update(Request $request, $id)
{
    $request->validate([
        'nomor_kwh' => 'required|exists:pelanggans,nomor_kwh',
        'bulan' => 'required|string',
        'tahun' => 'required|integer',
        'meter_awal' => 'required|integer',
        'meter_akhir' => 'required|integer|gte:meter_awal',
        'status' => 'required|in:lunas,belum lunas',
    ]);

    $tagihan = Tagihan::findOrFail($id);

    $pelanggan = Pelanggan::where('nomor_kwh', $request->nomor_kwh)->with('tarif')->first();

    $jumlahMeter = $request->meter_akhir - $request->meter_awal;
    $tarifPerKwh = $pelanggan->tarif->tarifperkwh ?? 1500;
    $totalTagihan = $jumlahMeter * $tarifPerKwh;

    $tagihan->update([
        'id_pelanggan' => $pelanggan->id,
        'bulan' => $request->bulan,
        'tahun' => $request->tahun,
        'jumlah_meter' => $jumlahMeter,
        'total_tagihan' => $totalTagihan,
        'status' => $request->status,
    ]);

    Log::info('Tagihan berhasil diperbarui:', $tagihan->toArray());

    return redirect()->route('tagihans.index')->with('success', 'Tagihan berhasil diperbarui!');
}


    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();

        return redirect()->route('tagihans.index')->with('success', 'Tagihan berhasil dihapus');
    }
}
