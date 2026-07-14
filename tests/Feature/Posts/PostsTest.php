<?php

namespace Tests\Feature\Posts;

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $validPayload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);

        $this->validPayload = [
            'title' => 'Kerja Bakti Desa Siwalan',
            'deskripsi' => 'Akan dilaksanakan kegiatan kerja bakti pada hari Minggu besok.',
            'tanggal' => '2026-07-15',
            'kategori' => 'Lingkungan',
        ];
    }

    public function test_it_shows_posts_index_page_to_authenticated_admin(): void
    {
        $response = $this->actingAs($this->admin)->get(route('posts.index'));
        $response->assertStatus(200);
    }

    public function test_it_validates_post_title_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['title' => '']);
        $response = $this->actingAs($this->admin)->post(route('posts.store'), $payload);
        $response->assertSessionHasErrors(['title']);
    }

    public function test_it_validates_post_description_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['deskripsi' => '']);
        $response = $this->actingAs($this->admin)->post(route('posts.store'), $payload);
        $response->assertSessionHasErrors(['deskripsi']);
    }

    public function test_it_validates_post_date_is_required(): void
    {
        $payload = array_merge($this->validPayload, ['tanggal' => '']);
        $response = $this->actingAs($this->admin)->post(route('posts.store'), $payload);
        $response->assertSessionHasErrors(['tanggal']);
    }

    public function test_it_validates_post_category_must_be_valid(): void
    {
        $payload = array_merge($this->validPayload, ['kategori' => 'BukanKategoriValid']);
        $response = $this->actingAs($this->admin)->post(route('posts.store'), $payload);
        $response->assertSessionHasErrors(['kategori']);
    }

    public function test_it_creates_a_new_post_with_valid_data(): void
    {
        $response = $this->actingAs($this->admin)->post(route('posts.store'), $this->validPayload);
        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHasNoErrors();

        $post = Post::first();
        $this->assertNotNull($post);
        $this->assertEquals('kerja-bakti-desa-siwalan', $post->slug);
        $this->assertEquals('Lingkungan', $post->kategori);
    }

    public function test_it_updates_a_post_with_valid_data(): void
    {
        $post = Post::create(array_merge($this->validPayload, [
            'slug' => 'kerja-bakti-desa-siwalan',
        ]));

        $response = $this->actingAs($this->admin)->put(route('posts.update', $post->slug), array_merge($this->validPayload, [
            'title' => 'Kerja Bakti Desa Siwalan Terupdate',
        ]));

        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHasNoErrors();

        $post->refresh();
        $this->assertEquals('kerja-bakti-desa-siwalan-terupdate', $post->slug);
    }

    public function test_it_deletes_a_post(): void
    {
        $post = Post::create(array_merge($this->validPayload, [
            'slug' => 'kerja-bakti-desa-siwalan',
        ]));

        $response = $this->actingAs($this->admin)->delete(route('posts.destroy', $post->slug));
        $response->assertRedirect(route('posts.index'));

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
