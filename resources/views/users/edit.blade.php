@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Pengguna</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Level -->
            <div class="col-md-6 mb-3">
                <label for="id_level" class="form-label">Level</label>
                <select id="id_level" name="id_level" class="form-select @error('id_level') is-invalid @enderror" required>
                    <option value="" disabled>Pilih Level</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id_level }}" {{ $user->id_level == $level->id_level ? 'selected' : '' }}>{{ $level->nama_level }}</option>
                    @endforeach
                </select>
                @error('id_level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
