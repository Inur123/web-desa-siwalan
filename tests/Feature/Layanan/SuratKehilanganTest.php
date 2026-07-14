<?php

namespace Tests\Feature\Layanan;

use App\Models\User;
use App\Models\SuratKehilangan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SuratKehilanganTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $validPayload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);

        $this->validPayload = [
            'nama' => 'Budi Santoso',
            'tempat_lahir' => 'Magetan',
            'ttl' => '1990-08-20',
            'nik' => '3171012345678902',
            'kewarganegaraan' => 'Indonesia',
            'agama' => 'Islam',
            'pekerjaan' => 'Swasta',
            'status_perkawinan' => 'Kawin',
            'alamat' => 'Jl. Melati No. 5 RT 02 RW 02 Desa Siwalan',
            'no_hp' => '081234567891',
            'barang_hilang' => 'Kartu Tanda Penduduk (KTP)',
            'keterangan' => 'Hilang di sekitar pasar tradisional Siwalan saat berbelanja.',
            'tanggal_hilang' => '2026-07-13',
            'waktu_hilang' => '10:00 WIB',
            'tempat_hilang' => 'Pasar Siwalan',
        ];

        Http::fake([
            'api.fonnte.com/*' => Http::response(['status' => true], 200),
        ]);
    }

    public function test_it_shows_surat_kehilangan_page(): void
    {
        $response = $this->get(route('guest.surat-kehilangan'));
        $response->assertStatus(200);
    }

    public function test_it_validates_name_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['nama' => '']);
        $response = $this->post(route('guest.surat-kehilangan.store'), $payload);
        $response->assertSessionHasErrors(['nama']);
    }

    public function test_it_validates_nik_must_be_16_digits(): void
    {
        $payload = array_merge($this->validPayload, ['nik' => '12345']);
        $response = $this->post(route('guest.surat-kehilangan.store'), $payload);
        $response->assertSessionHasErrors(['nik']);
    }

    public function test_it_validates_phone_number_must_be_numeric(): void
    {
        $payload = array_merge($this->validPayload, ['no_hp' => 'invalidphone']);
        $response = $this->post(route('guest.surat-kehilangan.store'), $payload);
        $response->assertSessionHasErrors(['no_hp']);
    }

    public function test_it_validates_barang_hilang_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['barang_hilang' => '']);
        $response = $this->post(route('guest.surat-kehilangan.store'), $payload);
        $response->assertSessionHasErrors(['barang_hilang']);
    }

    public function test_it_saves_surat_kehilangan_with_valid_data(): void
    {
        $response = $this->post(route('guest.surat-kehilangan.store'), $this->validPayload);
        $response->assertRedirect();

        $surat = SuratKehilangan::first();
        $this->assertNotNull($surat);
        $this->assertEquals('Budi Santoso', $surat->nama);
        $this->assertEquals('baru', $surat->status);
    }

    public function test_it_requires_alasan_ditolak_when_admin_rejects_surat_kehilangan(): void
    {
        $surat = SuratKehilangan::create(array_merge($this->validPayload, [
            'uuid' => \Illuminate\Support\Str::uuid(),
            'kode_layanan' => 'SKH-20260714-TEST1',
        ]));

        $this->actingAs($this->admin);
        $response = $this->patch(route('admin.surat-kehilangan.updateStatus', $surat->uuid), [
            'status' => 'ditolak',
            'alasan_ditolak' => '',
        ]);

        $response->assertSessionHasErrors(['alasan_ditolak']);
    }

    public function test_it_saves_reasons_for_rejection_when_admin_rejects_surat_kehilangan(): void
    {
        $surat = SuratKehilangan::create(array_merge($this->validPayload, [
            'uuid' => \Illuminate\Support\Str::uuid(),
            'kode_layanan' => 'SKH-20260714-TEST2',
        ]));

        $this->actingAs($this->admin);
        $response = $this->patch(route('admin.surat-kehilangan.updateStatus', $surat->uuid), [
            'status' => 'ditolak',
            'alasan_ditolak' => 'Lokasi kehilangan tidak valid.',
        ]);

        $response->assertSessionHasNoErrors();
        $surat->refresh();
        $this->assertEquals('ditolak', $surat->status);
        $this->assertEquals('Lokasi kehilangan tidak valid.', $surat->alasan_ditolak);
    }
}
