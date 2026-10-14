<?php

namespace Tests\Feature;

use App\Models\Consultation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsultationFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_consultation_page_renders_successfully(): void
    {
        $this->seed();

        $response = $this->get(route('consultation.create'));
        $response->assertStatus(200);
        $response->assertSee('Form Konsultasi Jaringan MikroTik');
    }

    public function test_homepage_renders_conversion_elements_and_consultation_form(): void
    {
        $this->seed();

        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('Jaringan Lambat');
        $response->assertSee('Sering Putus?');
        $response->assertSee('Formulir Konsultasi Jaringan');
        $response->assertSee('Chat WhatsApp');
        $response->assertSee('Konsultasi Gratis');
    }

    public function test_consultation_form_submits_and_creates_database_record(): void
    {
        $this->seed();

        $payload = [
            'name' => 'Bambang Sudiro',
            'email' => 'bambang@kantor.co.id',
            'phone' => '081299887766',
            'company_or_institution' => 'PT. Logistik Sukses',
            'service_type' => 'Multi-ISP Load Balancing & Failover',
            'mikrotik_model' => 'CCR2004-16G-2S+',
            'isp_count' => '2 Provider',
            'problem_description' => 'Kantor kami sering putus koneksi saat jam kerja, butuh load balancing 2 ISP otomatis.',
        ];

        $response = $this->post(route('consultation.store'), $payload);

        $this->assertDatabaseHas('consultations', [
            'name' => 'Bambang Sudiro',
            'email' => 'bambang@kantor.co.id',
            'status' => 'baru',
        ]);

        $consultation = Consultation::where('email', 'bambang@kantor.co.id')->first();
        $response->assertRedirect(route('consultation.success', ['id' => $consultation->id]));
    }

    public function test_consultation_validation_fails_when_fields_are_missing(): void
    {
        $response = $this->post(route('consultation.store'), []);
        $response->assertSessionHasErrors(['name', 'phone', 'service_type', 'problem_description']);
    }
}
