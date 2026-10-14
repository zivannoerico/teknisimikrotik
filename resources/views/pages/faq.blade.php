@extends('layouts.app')

@section('title', 'Tanya Jawab Lengkap (FAQ) - Jasa Setting MikroTik')
@section('meta_description', 'Pertanyaan umum mengenai proses pengerjaan live remote setting MikroTik, kunjungan on-site, jaminan garansi, dan metode pembayaran.')

@section('content')
{{-- 1. Hero Section --}}
<section class="border-b border-slate-200/80 bg-white py-14 sm:py-18">
    <div class="wrap">
        <div class="max-w-3xl text-left">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                Pusat Informasi &amp; Bantuan
            </span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Pertanyaan yang Sering Diajukan
            </h1>
            <p class="mt-3 text-base sm:text-lg leading-relaxed text-slate-600">
                Keterangan transparan seputar tata cara pengerjaan remote, kunjungan on-site, pendampingan uji coba, dan proses pembayaran.
            </p>
        </div>
    </div>
</section>

{{-- 2. FAQ Accordions Section --}}
<section class="section bg-surface" aria-labelledby="faq-list-title">
    <div class="wrap max-w-4xl space-y-8">
        <div class="max-w-2xl text-left mb-8">
            <h2 id="faq-list-title" class="text-xl sm:text-2xl font-bold tracking-tight text-navy-900">
                Daftar Tanya Jawab Seputar Layanan
            </h2>
            <p class="mt-1.5 text-sm text-slate-600">
                Klik pertanyaan untuk membaca penjelasan lengkap teknis dan operasional kami.
            </p>
        </div>

        <div class="space-y-3">
            @foreach($faqs as $faq)
                <div class="bg-white rounded-xl border border-slate-200/90 p-5 shadow-2xs">
                    <details class="group">
                        <summary class="flex justify-between items-center cursor-pointer font-bold text-navy-900 text-sm sm:text-base list-none gap-4">
                            <div class="flex items-center gap-2.5">
                                <span>{{ $faq->question }}</span>
                            </div>
                            <x-icon name="chevron-down" class="h-4 w-4 text-slate-400 transition-transform group-open:rotate-180 shrink-0" />
                        </summary>
                        <div class="mt-3 pt-3 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100">
                            <p class="whitespace-pre-line">{{ $faq->answer }}</p>
                        </div>
                    </details>
                </div>
            @endforeach
        </div>

        {{-- Support Assistance Card --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 p-7 sm:p-9 text-center space-y-3.5 shadow-2xs mt-10">
            <h3 class="text-xl sm:text-2xl font-bold font-heading text-navy-900">Punya Pertanyaan Spesifik Terkait Jaringan Anda?</h3>
            <p class="text-sm sm:text-base text-slate-600 max-w-lg mx-auto leading-relaxed">
                Silakan tanyakan langsung kepada tim kami tanpa dipungut biaya. Kami siap membantu mendiskusikan opsi solusi yang tepat.
            </p>
            <div class="pt-2">
                <a href="{{ $waLink('Halo, saya ingin menanyakan hal teknis seputar setting MikroTik.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-lg">
                    <x-icon name="whatsapp" class="h-5 w-5" />
                    <span>Chat WhatsApp Kami Sekarang</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
