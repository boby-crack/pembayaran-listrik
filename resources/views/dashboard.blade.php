@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Selamat Datang di Dashboard</h1>
<p>Gunakan menu di sidebar untuk mengelola data.</p>

<div class="row">
    <div class="col-md-4">
        <div class="card p-3">
            <h5>Total Users</h5>
            <p>100</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h5>Total Pelanggan</h5>
            <p>200</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h5>Total Tagihan</h5>
            <p>150</p>
        </div>
    </div>
</div>
@endsection
