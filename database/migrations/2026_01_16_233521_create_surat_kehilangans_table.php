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
        Schema::create('surat_kehilangans', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('kode_layanan')->unique();
            $table->text('nama'); // Changed to TEXT for encryption
            $table->text('tempat_lahir'); // Changed to TEXT for encryption
            $table->date('ttl');
            $table->text('nik'); // Changed to TEXT for encryption
            $table->text('kewarganegaraan')->nullable(); // Changed to TEXT for encryption
            $table->text('agama')->nullable(); // Changed to TEXT for encryption
            $table->text('pekerjaan')->nullable(); // Changed to TEXT for encryption
            $table->text('status_perkawinan')->nullable(); // Changed to TEXT for encryption
            $table->longText('alamat'); // Changed to LONGTEXT for encryption
            $table->text('no_hp'); // Changed to TEXT for encryption
            $table->text('barang_hilang'); // Changed to TEXT for encryption (contoh: KTP, SIM, dll)
            $table->longText('keterangan'); // Changed to LONGTEXT for encryption (detail kronologi kehilangan)
            $table->date('tanggal_hilang');
            $table->text('waktu_hilang')->nullable(); // Changed to TEXT for encryption (contoh: 10.00 WIB)
            $table->text('tempat_hilang')->nullable(); // Changed to TEXT for encryption (contoh: Rumah sendiri)
            $table->text('kk')->nullable(); // Changed to TEXT for encryption (file path)
            $table->text('ktp')->nullable(); // Changed to TEXT for encryption (file path)
            $table->text('pengantar_rt')->nullable(); // Changed to TEXT for encryption (file path)
            $table->enum('status', ['baru', 'diterima', 'ditolak'])->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_kehilangans');
    }
};
