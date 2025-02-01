<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('tagihans', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('id_penggunaan');
    $table->uuid('id_pelanggan');
    $table->string('bulan');
    $table->integer('tahun');
    $table->integer('jumlah_meter'); // Jumlah selisih meteran
    $table->float('total_tagihan'); // Tambahkan kolom total tagihan
    $table->string('status')->default('belum lunas'); // Ubah enum menjadi string untuk fleksibilitas
    $table->timestamps();

    // Foreign keys
    $table->foreign('id_penggunaan')->references('id')->on('penggunaans')->onDelete('cascade');
    $table->foreign('id_pelanggan')->references('id')->on('pelanggans')->onDelete('cascade');
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
