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
       Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_tagihan');
            $table->date('tanggal_pembayaran');
            $table->string('bulan_bayar');
            $table->float('biaya_admin');
            $table->float('total_bayar');
            $table->uuid('id_user');
            $table->timestamps();

            $table->foreign('id_tagihan')->references('id')->on('tagihans')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
