<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('users.create', compact('levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'id_level' => 'required|exists:levels,id_level',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_level' => $request->id_level,
        ]);


        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $levels = Level::all();
        return view('users.edit', compact('user', 'levels'));
    }

  public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'id_level' => 'required|exists:levels,id_level',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'id_level' => $request->id_level,
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
}



    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
