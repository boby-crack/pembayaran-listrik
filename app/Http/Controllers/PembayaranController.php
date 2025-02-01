<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::all();
        return view('pembayarans.index', compact('pembayarans'));
    }

    public function create()
    {
        $tagihans = Tagihan::all();
        $users = User::all();
        return view('pembayarans.create', compact('tagihans', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tagihan' => 'required|exists:tagihans,id',
            'id_user' => 'required|exists:users,id',
            'tanggal_pembayaran' => 'required|date',
            'bulan_bayar' => 'required|string',
            'biaya_admin' => 'required|numeric',
            'total_bayar' => 'required|numeric',
        ]);

        Pembayaran::create([
            'id' => Str::uuid(),
            'id_tagihan' => $request->id_tagihan,
            'id_user' => $request->id_user,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'bulan_bayar' => $request->bulan_bayar,
            'biaya_admin' => $request->biaya_admin,
            'total_bayar' => $request->total_bayar,
        ]);

        return redirect()->route('pembayarans.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }
}
