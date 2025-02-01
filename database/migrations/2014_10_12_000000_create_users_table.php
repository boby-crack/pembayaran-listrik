<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai Primary Key
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email unik
            $table->timestamp('email_verified_at')->nullable(); // Waktu verifikasi email
            $table->string('password'); // Kata sandi
            $table->unsignedBigInteger('id_level'); // Foreign key ke levels
            $table->foreign('id_level')->references('id_level')->on('levels')->onDelete('cascade');
            $table->rememberToken(); // Token remember me
            $table->timestamps(); // Tanggal dibuat & diupdate
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
