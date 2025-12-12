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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->uuid('uuid')->primary(); // ID pengaduan sendiri
            $table->text('nama'); // Changed to TEXT for encryption
            $table->text('no_hp'); // Changed to TEXT for encryption
            $table->longText('alamat'); // Changed to LONGTEXT for encryption
            $table->text('title'); // Changed to TEXT for encryption
            $table->longText('content'); // Changed to LONGTEXT for encryption
            $table->dateTime('tanggal');
            $table->text('foto')->nullable(); // Changed to TEXT for encryption
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
