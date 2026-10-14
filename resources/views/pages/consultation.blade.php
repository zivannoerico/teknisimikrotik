@extends('layouts.app')

@section('title', 'Formulir Konsultasi & Order Jasa Setting MikroTik')
@section('meta_description', 'Sampaikan kendala jaringan MikroTik Anda secara spesifik untuk mendapatkan solusi tepat dan cepat dari tim teknisi ahli.')

@section('content')
{{-- 1. Hero Section --}}
<section class="border-b border-slate-200/80 bg-white py-12 sm:py-16">
    <div class="wrap text-center space-y-3">
        <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
            Diagnosa Awal Gratis
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold font-heading text-navy-900 tracking-tight">
            Form Konsultasi Jaringan MikroTik
        </h1>
        <p class="text-slate-600 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
            Lengkapi data di bawah ini agar teknisi kami dapat menganalisis model router, jalur ISP, dan kendala koneksi Anda secara akurat sebelum sesi remote dimulai.
        </p>
    </div>
</section>

{{-- 2. Form Section --}}
<section class="py-12 sm:py-16 bg-surface">
    <div class="wrap max-w-3xl">
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-10 shadow-2xs">
            @php
                $serviceOptions = $services->pluck('title');
            @endphp

            @include('partials.consultation-form', [
                'serviceOptions' => $serviceOptions,
                'selectedService' => $selectedService,
                'extended' => true,
                'formId' => 'consultation-page'
            ])

            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-center gap-2 text-xs text-slate-500">
                <x-icon name="shield" class="h-4 w-4 text-emerald-600 shrink-0" />
                <span>Data Anda dijamin aman dan hanya digunakan untuk keperluan analisis teknis.</span>
            </div>
        </div>
    </div>
</section>
@endsection
