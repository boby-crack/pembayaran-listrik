<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('levels.index', compact('levels'));
    }

    public function create()
    {
        return view('levels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_level' => 'required|string|max:255',
        ]);

        Level::create($request->all());
        return redirect()->route('levels.index')->with('success', 'Level berhasil ditambahkan');
    }

    public function edit(Level $level)
    {
        return view('levels.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $request->validate([
            'nama_level' => 'required|string|max:255',
        ]);

        $level->update($request->all());
        return redirect()->route('levels.index')->with('success', 'Level berhasil diperbarui');
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('levels.index')->with('success', 'Level berhasil dihapus');
    }
}
