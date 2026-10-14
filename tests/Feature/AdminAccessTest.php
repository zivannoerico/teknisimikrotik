<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_accessing_admin_area(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('Login Admin Panel');
    }

    public function test_admin_can_login_with_correct_credentials(): void
    {
        $this->seed();

        $response = $this->post(route('login.post'), [
            'email' => 'admin@teknisimikrotik.id',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_authenticated_admin_can_access_dashboard_and_crud_pages(): void
    {
        $this->seed();
        $admin = User::where('email', 'admin@teknisimikrotik.id')->first();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Ringkasan Sistem');

        $servicesResponse = $this->actingAs($admin)->get(route('admin.services.index'));
        $servicesResponse->assertStatus(200);

        $pricingResponse = $this->actingAs($admin)->get(route('admin.pricing.index'));
        $pricingResponse->assertStatus(200);

        $consultationsResponse = $this->actingAs($admin)->get(route('admin.consultations.index'));
        $consultationsResponse->assertStatus(200);
    }

    public function test_admin_can_update_website_settings_including_hero_banner(): void
    {
        $this->seed();
        $admin = User::first();

        $response = $this->actingAs($admin)->post(route('admin.settings.update'), [
            'site_name' => 'TEKNISI MIKROTIK',
            'hero_title' => 'Judul Baru Jaringan? Solusi Terbaik.',
            'hero_subtitle' => 'Deskripsi baru jaringan mantap.',
        ]);

        $response->assertRedirect(route('admin.settings.index'));
        $this->assertEquals('Judul Baru Jaringan? Solusi Terbaik.', Setting::get('hero_title'));
        $this->assertEquals('Deskripsi baru jaringan mantap.', Setting::get('hero_subtitle'));

        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Judul Baru Jaringan?');
        $homeResponse->assertSee('Solusi Terbaik.');
        $homeResponse->assertSee('Deskripsi baru jaringan mantap.');
    }
}
