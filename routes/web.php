<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login')->with('success', 'Anda berhasil logout.');
})->name('logout');


Route::resource('levels', LevelController::class);
Route::resource('users', UserController::class);
Route::resource('tarifs', TarifController::class);
Route::resource('pelanggans', PelangganController::class);
Route::resource('penggunaans', PenggunaanController::class);
Route::resource('tagihans', TagihanController::class);
Route::resource('pembayarans', PembayaranController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/tagihans/get-bulan-tahun/{nomor_kwh}', [TagihanController::class, 'getBulanTahun']);
Route::get('/tagihans/get-penggunaan/{nomor_kwh}/{bulan}/{tahun}', [TagihanController::class, 'getPenggunaan']);


Route::get('/penggunaans/get-meter-awal/{nomor_kwh}', [PenggunaanController::class, 'getMeterAwal']);
Route::get('/penggunaans/get-bulan/{nomor_kwh}', [PenggunaanController::class, 'getBulan']);




require __DIR__.'/auth.php';
