<?php

namespace Tests\Feature\Layanan;

use App\Models\User;
use App\Models\Sktm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SktmTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $validPayload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);

        $this->validPayload = [
            'nama' => 'Ahmad Subarjo',
            'tempat_lahir' => 'Magetan',
            'ttl' => '1995-05-15',
            'jenis_kelamin' => 'Laki-laki',
            'kewarganegaraan' => 'Indonesia',
            'pendidikan' => 'SMA/SMK',
            'pekerjaan' => 'Wiraswasta',
            'status_perkawinan' => 'Belum Kawin',
            'nik' => '3171012345678901',
            'agama' => 'Islam',
            'alamat' => 'Jl. Mawar No. 12 RT 01 RW 01 Desa Siwalan',
            'no_hp' => '081234567890',
            'keperluan' => 'Pendaftaran Beasiswa Anak',
        ];

        Http::fake([
            'api.fonnte.com/*' => Http::response(['status' => true], 200),
        ]);
    }

    public function test_it_shows_sktm_page(): void
    {
        $response = $this->get(route('guest.sktm'));
        $response->assertStatus(200);
    }

    public function test_it_validates_name_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['nama' => '']);
        $response = $this->post(route('guest.sktm.store'), $payload);
        $response->assertSessionHasErrors(['nama']);
    }

    public function test_it_validates_name_must_only_contain_letters_and_spaces(): void
    {
        $payload = array_merge($this->validPayload, ['nama' => 'Ahmad123']);
        $response = $this->post(route('guest.sktm.store'), $payload);
        $response->assertSessionHasErrors(['nama']);
    }

    public function test_it_validates_nik_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['nik' => '']);
        $response = $this->post(route('guest.sktm.store'), $payload);
        $response->assertSessionHasErrors(['nik']);
    }

    public function test_it_validates_nik_must_be_16_digits(): void
    {
        $payload = array_merge($this->validPayload, ['nik' => '123456']);
        $response = $this->post(route('guest.sktm.store'), $payload);
        $response->assertSessionHasErrors(['nik']);
    }

    public function test_it_validates_phone_number_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['no_hp' => '']);
        $response = $this->post(route('guest.sktm.store'), $payload);
        $response->assertSessionHasErrors(['no_hp']);
    }

    public function test_it_validates_phone_number_must_be_numeric(): void
    {
        $payload = array_merge($this->validPayload, ['no_hp' => 'notanumber']);
        $response = $this->post(route('guest.sktm.store'), $payload);
        $response->assertSessionHasErrors(['no_hp']);
    }

    public function test_it_saves_sktm_with_valid_data(): void
    {
        $response = $this->post(route('guest.sktm.store'), $this->validPayload);
        $response->assertRedirect();
        
        $sktm = Sktm::first();
        $this->assertNotNull($sktm);
        $this->assertEquals('Ahmad Subarjo', $sktm->nama);
        $this->assertEquals('baru', $sktm->status);
    }

    public function test_it_requires_alasan_ditolak_when_admin_rejects_sktm(): void
    {
        $sktm = Sktm::create(array_merge($this->validPayload, [
            'uuid' => \Illuminate\Support\Str::uuid(),
            'kode_layanan' => 'SKTM-20260714-TEST1',
        ]));

        $this->actingAs($this->admin);
        $response = $this->patch(route('admin.sktm.updateStatus', $sktm->uuid), [
            'status' => 'ditolak',
            'alasan_ditolak' => '',
        ]);

        $response->assertSessionHasErrors(['alasan_ditolak']);
    }

    public function test_it_saves_reasons_for_rejection_when_admin_rejects_sktm(): void
    {
        $sktm = Sktm::create(array_merge($this->validPayload, [
            'uuid' => \Illuminate\Support\Str::uuid(),
            'kode_layanan' => 'SKTM-20260714-TEST2',
        ]));

        $this->actingAs($this->admin);
        $response = $this->patch(route('admin.sktm.updateStatus', $sktm->uuid), [
            'status' => 'ditolak',
            'alasan_ditolak' => 'File pendukung tidak valid.',
        ]);

        $response->assertSessionHasNoErrors();
        $sktm->refresh();
        $this->assertEquals('ditolak', $sktm->status);
        $this->assertEquals('File pendukung tidak valid.', $sktm->alasan_ditolak);
    }
}
