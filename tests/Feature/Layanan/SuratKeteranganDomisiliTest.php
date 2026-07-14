<?php

namespace Tests\Feature\Layanan;

use App\Models\User;
use App\Models\SuratKeteranganDomisili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SuratKeteranganDomisiliTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $validPayload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);

        $this->validPayload = [
            'nama' => 'Siti Aminah',
            'tempat_lahir' => 'Magetan',
            'ttl' => '1998-12-01',
            'nik' => '3171012345678903',
            'jenis_kelamin' => 'Perempuan',
            'kewarganegaraan' => 'Indonesia',
            'agama' => 'Islam',
            'pekerjaan' => 'Guru',
            'status_perkawinan' => 'Belum Kawin',
            'alamat' => 'Jl. Dahlia No. 8 RT 03 RW 03 Desa Siwalan',
            'no_hp' => '081234567892',
            'rt' => '03',
            'rw' => '03',
            'dukuh' => 'Siwalan Krajan',
            'tahun_domisili' => '2020',
        ];

        Http::fake([
            'api.fonnte.com/*' => Http::response(['status' => true], 200),
        ]);
    }

    public function test_it_shows_surat_keterangan_domisili_page(): void
    {
        $response = $this->get(route('guest.surat-keterangan-domisili'));
        $response->assertStatus(200);
    }

    public function test_it_validates_name_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['nama' => '']);
        $response = $this->post(route('guest.surat-keterangan-domisili.store'), $payload);
        $response->assertSessionHasErrors(['nama']);
    }

    public function test_it_validates_nik_must_be_16_digits(): void
    {
        $payload = array_merge($this->validPayload, ['nik' => '123456789']);
        $response = $this->post(route('guest.surat-keterangan-domisili.store'), $payload);
        $response->assertSessionHasErrors(['nik']);
    }

    public function test_it_validates_phone_number_must_be_numeric(): void
    {
        $payload = array_merge($this->validPayload, ['no_hp' => 'invalidphone']);
        $response = $this->post(route('guest.surat-keterangan-domisili.store'), $payload);
        $response->assertSessionHasErrors(['no_hp']);
    }

    public function test_it_saves_surat_keterangan_domisili_with_valid_data(): void
    {
        $response = $this->post(route('guest.surat-keterangan-domisili.store'), $this->validPayload);
        $response->assertRedirect();

        $domisili = SuratKeteranganDomisili::first();
        $this->assertNotNull($domisili);
        $this->assertEquals('Siti Aminah', $domisili->nama);
        $this->assertEquals('baru', $domisili->status);
    }

    public function test_it_requires_alasan_ditolak_when_admin_rejects_surat_domisili(): void
    {
        $domisili = SuratKeteranganDomisili::create(array_merge($this->validPayload, [
            'uuid' => \Illuminate\Support\Str::uuid(),
            'kode_layanan' => 'SKD-20260714-TEST1',
        ]));

        $this->actingAs($this->admin);
        $response = $this->patch(route('admin.surat-keterangan-domisili.updateStatus', $domisili->uuid), [
            'status' => 'ditolak',
            'alasan_ditolak' => '',
        ]);

        $response->assertSessionHasErrors(['alasan_ditolak']);
    }

    public function test_it_saves_reasons_for_rejection_when_admin_rejects_surat_domisili(): void
    {
        $domisili = SuratKeteranganDomisili::create(array_merge($this->validPayload, [
            'uuid' => \Illuminate\Support\Str::uuid(),
            'kode_layanan' => 'SKD-20260714-TEST2',
        ]));

        $this->actingAs($this->admin);
        $response = $this->patch(route('admin.surat-keterangan-domisili.updateStatus', $domisili->uuid), [
            'status' => 'ditolak',
            'alasan_ditolak' => 'Data alamat tidak cocok.',
        ]);

        $response->assertSessionHasNoErrors();
        $domisili->refresh();
        $this->assertEquals('ditolak', $domisili->status);
        $this->assertEquals('Data alamat tidak cocok.', $domisili->alasan_ditolak);
    }
}
