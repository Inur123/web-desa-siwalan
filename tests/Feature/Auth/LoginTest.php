<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_login_form(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertSee('login');
    }

    public function test_it_validates_email_is_required(): void
    {
        $response = $this->post(route('login.store'), [
            'email' => '',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_it_validates_email_must_be_valid_email(): void
    {
        $response = $this->post(route('login.store'), [
            'email' => 'bukan-email',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_it_validates_password_is_required(): void
    {
        $response = $this->post(route('login.store'), [
            'email' => 'admin@gmail.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_it_rejects_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post(route('login.store'), [
            'email' => 'admin@gmail.com',
            'password' => 'salah123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    public function test_it_accepts_valid_credentials(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login.store'), [
            'email' => 'admin@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_it_redirects_authenticated_users_from_login_page(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get(route('login'));

        $response->assertRedirect(route('admin.dashboard'));
    }
}
