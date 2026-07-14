<?php

namespace Tests\Feature\Pengaduan;

use App\Models\Pengaduan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengaduanTest extends TestCase
{
    use RefreshDatabase;

    protected $validPayload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validPayload = [
            'nama' => 'Joko Widodo',
            'no_hp' => '089876543210',
            'alamat' => 'RT 04 RW 02 Dukuh Siwalan Indah',
            'title' => 'Jalan Rusak Parah',
            'content' => 'Jalan utama desa di dekat persawahan berlubang cukup parah dan membahayakan warga.',
        ];
    }

    public function test_it_shows_pengaduan_page(): void
    {
        $response = $this->get(route('guest.pengaduan'));
        $response->assertStatus(200);
    }

    public function test_it_validates_name_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['nama' => '']);
        $response = $this->post(route('pengaduan.store'), $payload);
        $response->assertSessionHasErrors(['nama']);
    }

    public function test_it_validates_phone_number_must_be_numeric(): void
    {
        $payload = array_merge($this->validPayload, ['no_hp' => 'invalidphone']);
        $response = $this->post(route('pengaduan.store'), $payload);
        $response->assertSessionHasErrors(['no_hp']);
    }

    public function test_it_validates_title_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['title' => '']);
        $response = $this->post(route('pengaduan.store'), $payload);
        $response->assertSessionHasErrors(['title']);
    }

    public function test_it_validates_content_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['content' => '']);
        $response = $this->post(route('pengaduan.store'), $payload);
        $response->assertSessionHasErrors(['content']);
    }

    public function test_it_saves_pengaduan_with_valid_data(): void
    {
        $response = $this->post(route('pengaduan.store'), $this->validPayload);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseCount('pengaduans', 1);

        $pengaduan = Pengaduan::first();
        $this->assertNotNull($pengaduan);
        $this->assertEquals('Joko Widodo', $pengaduan->nama);
        $this->assertEquals('Jalan Rusak Parah', $pengaduan->title);
    }
}
