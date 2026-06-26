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
        Schema::create('antrean', function (Blueprint $table) {
            $table->id('id_antrean'); 
            $table->date('tanggal_periksa');
            $table->integer('nomor_urut')->default(0);
            $table->enum('status', ['menunggu', 'dipanggil', 'dilewati', 'selesai'])->default('menunggu');
            
            // --- BAGIAN YANG DIUBAH ---
            // Sesuaikan dengan tipe data INT di tabel bawaan temanmu
            $table->integer('id_pasien');
            $table->integer('id_akun');
            $table->integer('id_poli')->nullable();
            // --------------------------

            $table->foreign('id_pasien')->references('id_pasien')->on('pasien');
            $table->foreign('id_akun')->references('id_akun')->on('akun_pengguna');
            $table->foreign('id_poli')->references('id_poli')->on('poli');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrean');
    }
};