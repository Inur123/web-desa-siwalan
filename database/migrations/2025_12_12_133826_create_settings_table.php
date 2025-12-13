<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            [
                'key' => 'kop_surat_kabupaten',
                'value' => 'PEMERINTAH KABUPATEN MAGETAN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'kop_surat_kecamatan',
                'value' => 'KECAMATAN PANEKAN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'kop_surat_desa',
                'value' => 'DESA SIWALAN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'kop_surat_alamat',
                'value' => 'Jl. Raya Siwalan No. 01, Kode Pos 63396',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'kop_surat_kontak',
                'value' => 'Email: desasiwalan@magetan.go.id | Telp: (0351) 123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'nama_kepala_desa',
                'value' => 'NAMA KEPALA DESA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'nip_kepala_desa',
                'value' => '19xxxxxxxxxxxxxxx',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'logo_kop_surat',
                'value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'fonnte_token',
                'value' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'fontte_admin_phone',
                'value' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
