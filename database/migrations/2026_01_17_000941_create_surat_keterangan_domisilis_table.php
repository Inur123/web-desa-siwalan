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
        Schema::create('surat_keterangan_domisilis', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('kode_layanan')->unique();
            $table->text('nama'); // Encrypted
            $table->text('tempat_lahir'); // Encrypted
            $table->date('ttl');
            $table->text('nik'); // Encrypted
            $table->text('jenis_kelamin')->nullable(); // Encrypted
            $table->text('kewarganegaraan')->nullable(); // Encrypted
            $table->text('agama')->nullable(); // Encrypted
            $table->text('pekerjaan')->nullable(); // Encrypted
            $table->text('status_perkawinan')->nullable(); // Encrypted
            $table->longText('alamat'); // Encrypted
            $table->text('no_hp'); // Encrypted
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('dukuh')->nullable();
            $table->string('tahun_domisili')->nullable(); // Sejak tahun berapa
            $table->text('kk')->nullable(); // Encrypted file path
            $table->text('ktp')->nullable(); // Encrypted file path
            $table->text('pengantar_rt')->nullable(); // Encrypted file path
            $table->enum('status', ['baru', 'diterima', 'ditolak'])->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan_domisilis');
    }
};
