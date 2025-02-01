@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Pengguna</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Level -->
            <div class="col-md-6 mb-3">
                <label for="id_level" class="form-label">Level</label>
                <select id="id_level" name="id_level" class="form-select @error('id_level') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih Level</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id_level }}" {{ old('id_level') == $level->id_level ? 'selected' : '' }}>{{ $level->nama_level }}</option>
                    @endforeach
                </select>
                @error('id_level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
