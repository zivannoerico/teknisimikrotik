@extends('layouts.app')

@section('title', 'Kontak & Dukungan Teknis - TEKNISI MIKROTIK INDONESIA')
@section('meta_description', 'Hubungi kami via WhatsApp atau formulir website untuk konsultasi setting router MikroTik, penanganan remote, dan jadwal kunjungan teknisi.')

@section('content')
{{-- 1. Hero Section --}}
<section class="border-b border-slate-200/80 bg-white py-14 sm:py-18">
    <div class="wrap">
        <div class="max-w-3xl text-left">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                Pusat Layanan &amp; Bantuan
            </span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Kontak &amp; Konsultasi Teknis
            </h1>
            <p class="mt-3 text-base sm:text-lg leading-relaxed text-slate-600">
                Kami siap melayani kebutuhan konsultasi jaringan Anda, baik secara live remote terenkripsi untuk seluruh Indonesia maupun kunjungan on-site visit.
            </p>
        </div>
    </div>
</section>

{{-- 2. Content Grid --}}
<section class="section bg-surface" aria-labelledby="contact-form-title">
    <div class="wrap">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            {{-- Kolom Kiri: Informasi Kontak Resmi --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 space-y-6 shadow-2xs">
                    <h2 class="text-lg sm:text-xl font-bold font-heading text-navy-900 border-b border-slate-100 pb-4">
                        Saluran Komunikasi Resmi
                    </h2>

                    <div class="space-y-3.5">
                        @if(!empty($siteSettings['whatsapp_number']))
                            <div class="flex items-start gap-3.5 p-3.5 sm:p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <x-icon name="whatsapp" class="h-5 w-5" />
                                </div>
                                <div class="min-w-0">
                                    <span class="text-xs font-medium text-slate-500 uppercase block">WhatsApp Hotline</span>
                                    <a href="{{ $waLink('Halo, saya ingin konsultasi teknis jaringan.') }}" target="_blank" rel="noopener noreferrer" class="text-sm sm:text-base font-bold text-navy-900 hover:text-emerald-600 transition-colors block mt-0.5 truncate">
                                        {{ $siteSettings['whatsapp_display'] ?? $siteSettings['whatsapp_number'] }}
                                    </a>
                                    <span class="text-xs text-slate-500 block mt-0.5">Respon cepat via chat WhatsApp</span>
                                </div>
                            </div>
                        @endif

                        @if(!empty($siteSettings['email']))
                            <div class="flex items-start gap-3.5 p-3.5 sm:p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <x-icon name="mail" class="h-5 w-5" />
                                </div>
                                <div class="min-w-0">
                                    <span class="text-xs font-medium text-slate-500 uppercase block">Email Korespondensi</span>
                                    <a href="mailto:{{ $siteSettings['email'] }}" class="text-xs sm:text-sm font-semibold text-navy-900 hover:text-blue-600 transition-colors block mt-0.5 break-all">
                                        {{ $siteSettings['email'] }}
                                    </a>
                                    <span class="text-xs text-slate-500 block mt-0.5">Untuk surat penawaran &amp; kebutuhan RFQ</span>
                                </div>
                            </div>
                        @endif

                        @if(!empty($siteSettings['operational_hours']))
                            <div class="flex items-start gap-3.5 p-3.5 sm:p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <x-icon name="clock" class="h-5 w-5" />
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-slate-500 uppercase block">Jam Operasional Layanan</span>
                                    <p class="text-xs sm:text-sm font-semibold text-navy-900 mt-0.5">
                                        {{ $siteSettings['operational_hours'] }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if(!empty($siteSettings['address']))
                            <div class="flex items-start gap-3.5 p-3.5 sm:p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <x-icon name="pin" class="h-5 w-5" />
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-slate-500 uppercase block">Wilayah Jangkauan Layanan</span>
                                    <p class="text-xs sm:text-sm text-slate-700 mt-0.5 leading-relaxed">
                                        {{ $siteSettings['address'] }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="pt-2">
                        <a href="{{ $waLink('Halo, saya ingin konsultasi langsung via WhatsApp.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-block">
                            <x-icon name="whatsapp" class="h-5 w-5" />
                            <span>Chat WhatsApp Langsung</span>
                        </a>
                    </div>
                </div>

                {{-- Petunjuk Alur Konsultasi --}}
                <div class="bg-blue-50/60 border border-blue-200/80 rounded-2xl p-6 space-y-2.5">
                    <h3 class="text-sm font-bold text-navy-900 font-heading">Petunjuk Konsultasi Cepat</h3>
                    <ul class="space-y-2 text-xs sm:text-sm text-slate-700">
                        <li class="flex items-start gap-2">
                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0 mt-0.5" />
                            <span>Sertakan tipe model router MikroTik yang Anda gunakan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0 mt-0.5" />
                            <span>Sampaikan jumlah penyedia internet (ISP) yang terpasang</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0 mt-0.5" />
                            <span>Jelaskan kendala utama yang ingin diselesaikan</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Kolom Kanan: Formulir Konsultasi Terstruktur --}}
            <div class="lg:col-span-7">
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-9 shadow-2xs space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-700">Formulir Online</span>
                        <h2 id="contact-form-title" class="text-xl sm:text-2xl font-bold font-heading text-navy-900 mt-1">
                            Sampaikan Kendala Jaringan Anda
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1.5 leading-relaxed">
                            Isi formulir terstruktur di bawah ini agar tim teknis kami dapat segera memahami kebutuhan dan mendiskusikan opsi solusi via WhatsApp.
                        </p>
                    </div>

                    @include('partials.consultation-form', ['serviceOptions' => $serviceOptions, 'formId' => 'contact'])
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
