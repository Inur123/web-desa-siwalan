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
        Schema::create('sktms', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->text('nama'); // Changed to TEXT for encryption
            $table->text('nik'); // Changed to TEXT for encryption
            $table->date('ttl');
            $table->string('kode_layanan')->unique();
            $table->text('tempat_lahir'); // Changed to TEXT for encryption
            $table->longText('alamat'); // Changed to LONGTEXT for encryption
            $table->text('status_perkawinan'); // Changed to TEXT for encryption
            $table->text('no_hp'); // Changed to TEXT for encryption
            $table->text('nama_anak')->nullable(); // Changed to TEXT for encryption
            $table->text('keperluan'); // Changed to TEXT for encryption
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
        Schema::dropIfExists('sktms');
    }
};
