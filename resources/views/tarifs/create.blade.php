@extends('layouts.app')

@section('content')
<h1>Tambah Tarif</h1>

<form action="{{ route('tarifs.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="daya">Daya</label>
        <input type="number" name="daya" class="form-control">
    </div>
    <div class="form-group">
        <label for="tarifperkwh">Tarif per kWh</label>
        <input type="number" step="0.01" name="tarifperkwh" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
