<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::all();
        return view('tarifs.index', compact('tarifs'));
    }

    public function create()
    {
        return view('tarifs.create');
    }

/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
/******  3c463826-ae61-4f87-bdac-e4f7d15f5391  *******/    public function store(Request $request)
    {
        $request->validate([
            'daya' => 'required|integer',
            'tarifperkwh' => 'required|numeric',
        ]);

        Tarif::create($request->all());
        return redirect()->route('tarifs.index')->with('success', 'Tarif berhasil ditambahkan');
    }

    public function edit(Tarif $tarif)
    {
        return view('tarifs.edit', compact('tarif'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'daya' => 'required|integer',
            'tarifperkwh' => 'required|numeric',
        ]);

        $tarif->update($request->all());
        return redirect()->route('tarifs.index')->with('success', 'Tarif berhasil diperbarui');
    }

    public function destroy(Tarif $tarif)
    {
        $tarif->delete();
        return redirect()->route('tarifs.index')->with('success', 'Tarif berhasil dihapus');
    }
}
