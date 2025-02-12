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
        Schema::create('penggunaans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_pelanggan');
            $table->string('bulan');
            $table->integer('tahun');
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id')->on('pelanggans')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaans');
    }
};
