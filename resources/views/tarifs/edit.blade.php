@extends('layouts.app')

@section('content')
<h1>Edit Tarif</h1>

<form action="{{ route('tarifs.update', $tarif->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="daya">Daya</label>
        <input type="number" name="daya" class="form-control" value="{{ $tarif->daya }}">
    </div>
    <div class="form-group">
        <label for="tarifperkwh">Tarif per kWh</label>
        <input type="number" step="0.01" name="tarifperkwh" class="form-control" value="{{ $tarif->tarifperkwh }}">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
