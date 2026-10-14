<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesRedesignTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_all_public_pages_render_with_status_200(): void
    {
        $urls = [
            '/',
            '/layanan',
            '/paket-harga',
            '/portofolio',
            '/tentang-kami',
            '/blog',
            '/faq',
            '/kontak',
            '/konsultasi',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
        }

        // Test dynamic detail pages
        $service = Service::where('is_active', true)->first();
        if ($service) {
            $this->get('/layanan/'.$service->slug)->assertStatus(200);
        }

        $portfolio = Portfolio::where('is_active', true)->first();
        if ($portfolio) {
            $this->get('/portofolio/'.$portfolio->slug)->assertStatus(200);
        }

        $article = Article::where('is_published', true)->first();
        if ($article) {
            $this->get('/blog/'.$article->slug)->assertStatus(200);
        }
    }

    public function test_public_layout_includes_reorganized_footer_and_floating_actions(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Jelajahi');
        $response->assertSee('Tentang');
        $response->assertSee('id="scroll-to-top"', false);
        $response->assertSee('id="wa-float"', false);
        $response->assertSee('wa-ping-ring', false);
        $response->assertSeeInOrder([
            'Jaringan Anda Mengalami Masalah Ini?',
            'Layanan Jaringan',
            'Cara Kerja Kami',
            'Mengapa Memilih',
            'Paket &amp; Harga Konfigurasi',
            'Portofolio Pengerjaan',
            'Butuh Jaringan yang Lebih Stabil?',
        ], false);
    }

    public function test_internal_pages_render_consistent_editorial_sections(): void
    {
        $this->get('/layanan')
            ->assertStatus(200)
            ->assertSee('Katalog Layanan Spesialis')
            ->assertSee('Bagaimana Kami Menangani Jaringan Anda');

        $this->get('/paket-harga')
            ->assertStatus(200)
            ->assertSee('Struktur Biaya Transparan')
            ->assertSee('Pilihan Paket Konfigurasi');

        $this->get('/portofolio')
            ->assertStatus(200)
            ->assertSee('Hasil Nyata Lapangan');

        $this->get('/tentang-kami')
            ->assertStatus(200)
            ->assertSee('Tentang TEKNISIMIKROTIK');

        $this->get('/blog')
            ->assertStatus(200)
            ->assertSee('Edukasi Jaringan');

        $this->get('/faq')
            ->assertStatus(200)
            ->assertSee('Pertanyaan yang Sering Diajukan');

        $this->get('/kontak')
            ->assertStatus(200)
            ->assertSee('Saluran Komunikasi Resmi');

        $this->get('/konsultasi')
            ->assertStatus(200)
            ->assertSee('Diagnosa Awal Gratis')
            ->assertSee('Form Konsultasi Jaringan MikroTik');
    }

    public function test_all_admin_module_pages_render_with_status_200_for_authenticated_admin(): void
    {
        $admin = User::first();

        $adminUrls = [
            '/admin',
            '/admin/services',
            '/admin/services/create',
            '/admin/pricing',
            '/admin/pricing/create',
            '/admin/portfolios',
            '/admin/portfolios/create',
            '/admin/articles',
            '/admin/articles/create',
            '/admin/faqs',
            '/admin/faqs/create',
            '/admin/consultations',
            '/admin/settings',
        ];

        foreach ($adminUrls as $url) {
            $response = $this->actingAs($admin)->get($url);
            $response->assertStatus(200);
        }
    }
}
