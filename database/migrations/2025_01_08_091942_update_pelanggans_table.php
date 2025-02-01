<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Ubah nama kolom menggunakan query mentah jika `renameColumn` tidak didukung
        DB::statement('ALTER TABLE pelanggans CHANGE username name VARCHAR(255)');
        DB::statement('ALTER TABLE pelanggans CHANGE nama_pelanggan nomor_hp VARCHAR(15)');
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        // Kembalikan nama kolom ke aslinya
        DB::statement('ALTER TABLE pelanggans CHANGE name username VARCHAR(255)');
        DB::statement('ALTER TABLE pelanggans CHANGE nomor_hp nama_pelanggan VARCHAR(255)');
    }
};
