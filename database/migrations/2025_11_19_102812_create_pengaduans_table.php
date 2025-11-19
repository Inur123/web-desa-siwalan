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
            $table->uuid('user_id'); // UUID user pengirim
            $table->string('title');
            $table->text('content');
            $table->dateTime('tanggal');
            $table->string('foto')->nullable();
            $table->timestamps();

            // Relasi ke users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
