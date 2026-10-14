<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ConsultationController extends Controller
{
    public function create(Request $request): View
    {
        $selectedService = $request->query('service');
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.consultation', compact('services', 'selectedService'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => ['required', 'string', 'max:25', 'regex:/^[0-9+\-\s()]{8,25}$/'],
            'company_or_institution' => 'nullable|string|max:150',
            'service_type' => 'required|string|max:100',
            'mikrotik_model' => 'nullable|string|max:100',
            'isp_count' => 'nullable|string|max:50',
            'user_count' => 'nullable|string|max:50',
            'problem_description' => 'required|string|min:10|max:2000',
        ], [
            'phone.regex' => 'Nomor WhatsApp hanya boleh berisi angka, spasi, tanda + atau -.',
        ]);

        $validated['status'] = 'baru';

        $consultation = Consultation::create($validated);

        $waNumber = Setting::get('whatsapp_number');
        $waUrl = null;

        if ($waNumber) {
            $msg = "Halo, saya sudah mengirim formulir konsultasi di website:\n".
                   "Nama: {$consultation->name}\n".
                   "Kebutuhan: {$consultation->service_type}\n".
                   'Jumlah user/perangkat: '.($consultation->user_count ?: '-')."\n".
                   'Masalah: '.Str::limit($consultation->problem_description, 160);

            $waUrl = 'https://wa.me/'.Setting::normalizeWhatsAppNumber($waNumber).'?text='.rawurlencode($msg);
        }

        return redirect()->route('consultation.success', ['id' => $consultation->id])
            ->with('wa_url', $waUrl)
            ->with('success', 'Permohonan konsultasi Anda berhasil dikirim. Kami akan menghubungi Anda melalui WhatsApp.')
            ->with('submitted_consultation_id', $consultation->id);
    }

    public function success(Request $request, int $id): View|RedirectResponse
    {
        $request->session()->keep(['wa_url', 'success', 'submitted_consultation_id']);

        if ((int) $request->session()->get('submitted_consultation_id') !== $id) {
            return redirect()->route('home');
        }

        $consultation = Consultation::findOrFail($id);

        return view('pages.consultation-success', compact('consultation'));
    }
}
