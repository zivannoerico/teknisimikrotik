@extends('layouts.app')

@section('title', 'Daftar Paket & Harga Jasa Setting MikroTik Transparan')
@section('meta_description', 'Pilihan paket jasa setting router MikroTik transparan: Paket Basic, Paket Bisnis & Multi-ISP, dan Paket Enterprise Antar-Cabang.')

@section('content')
{{-- 1. Hero Section --}}
<section class="border-b border-slate-200/80 bg-white py-14 sm:py-18">
    <div class="wrap">
        <div class="max-w-3xl text-left">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                Struktur Biaya Transparan
            </span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Paket &amp; Estimasi Biaya Jasa Setting
            </h1>
            <p class="mt-3 text-base sm:text-lg leading-relaxed text-slate-600">
                Biaya jasa sekali setting transparan tanpa biaya tersembunyi. Termasuk pendampingan pengujian koneksi, penyerahan file backup konfigurasi, dan masa garansi purnajual.
            </p>
        </div>
    </div>
</section>

{{-- 2. Pricing Cards Grid --}}
<section class="section bg-surface" aria-labelledby="pricing-plans-title">
    <div class="wrap">
        <div class="max-w-2xl text-left mb-10 sm:mb-12">
            <h2 id="pricing-plans-title" class="text-2xl sm:text-3xl font-extrabold tracking-tight text-navy-900 leading-tight">
                Pilihan Paket Konfigurasi
            </h2>
            <p class="mt-2 text-sm sm:text-base leading-relaxed text-slate-600">
                Pilih paket berdasarkan skala pengguna dan kompleksitas arsitektur jaringan tempat usaha Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 items-stretch">
            @foreach($plans as $plan)
                @php $isFeatured = $plan->is_popular; @endphp
                <article class="flex flex-col justify-between rounded-2xl border p-6 sm:p-7 xl:p-8 transition-all {{ $isFeatured
                    ? 'border-blue-600 bg-white shadow-md ring-1 ring-blue-600'
                    : 'border-slate-200/90 bg-white shadow-2xs hover:border-slate-300' }}">

                    <div>
                        {{-- Badge Header Row (Sejajar di semua card) --}}
                        <div class="flex items-center min-h-[1.75rem] mb-3.5">
                            @if($isFeatured)
                                <span class="inline-flex rounded-full bg-blue-50 px-3 py-0.5 text-xs font-bold uppercase tracking-wider text-blue-700 border border-blue-200/60">
                                    {{ $plan->badge ?: 'Paling Populer' }}
                                </span>
                            @elseif(!empty($plan->badge))
                                <span class="inline-flex rounded-full bg-slate-100 px-3 py-0.5 text-xs font-semibold text-slate-700 border border-slate-200/80">
                                    {{ $plan->badge }}
                                </span>
                            @else
                                <span class="inline-block h-5"></span>
                            @endif
                        </div>

                        {{-- Judul Paket --}}
                        <h3 class="text-xl sm:text-2xl font-bold font-heading text-navy-900 min-h-[3.25rem] flex items-center leading-snug">
                            {{ $plan->name }}
                        </h3>

                        {{-- Deskripsi Paket --}}
                        <p class="text-slate-600 text-sm mt-2 leading-relaxed min-h-[3.75rem]">
                            {{ $plan->description }}
                        </p>

                        {{-- Biaya Jasa --}}
                        <div class="pt-5 mt-5 border-t border-slate-100">
                            <span class="text-xs text-slate-500 font-medium block">Biaya Jasa:</span>
                            <div class="mt-1.5 flex flex-wrap items-baseline gap-x-2 gap-y-0.5 min-h-[2.5rem]">
                                <span class="text-2xl sm:text-3xl lg:text-[1.75rem] xl:text-3xl font-extrabold font-heading text-navy-900 tracking-tight whitespace-nowrap">
                                    {{ $plan->formatted_price ?? ('Rp ' . number_format($plan->price, 0, ',', '.')) }}
                                </span>
                                @if(!empty($plan->billing_period))
                                    <span class="text-xs sm:text-sm text-slate-500 font-normal whitespace-nowrap">/ {{ $plan->billing_period }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- Fitur / Cakupan Layanan --}}
                        @if(!empty($plan->features))
                            <div class="pt-5 mt-5 border-t border-slate-100">
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Cakupan Layanan:</p>
                                <ul class="space-y-2.5 text-xs sm:text-sm text-slate-700">
                                    @foreach($plan->features as $f)
                                        <li class="flex items-start gap-2.5">
                                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0 mt-0.5" />
                                            <span class="leading-relaxed">{{ $f }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="{{ $waLink('Halo, saya tertarik dengan ' . $plan->name . '. Bisa dijelaskan detailnya?') }}"
                           target="_blank" rel="noopener noreferrer"
                           class="btn btn-block {{ $isFeatured ? 'btn-wa' : 'btn-outline' }}">
                            <x-icon name="whatsapp" class="h-4 w-4" />
                            <span>Pilih &amp; Tanya Paket Ini</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- 3. Custom Scope Inquiry Box --}}
        <div class="mt-12 sm:mt-16 bg-white border border-slate-200/90 rounded-2xl p-7 sm:p-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 shadow-2xs">
            <div class="space-y-2 text-left max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-700">Kebutuhan Skala Besar</span>
                <h3 class="text-xl sm:text-2xl font-bold font-heading text-navy-900">Butuh Konfigurasi Khusus atau Kunjungan On-Site?</h3>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Untuk kebutuhan topologi BGP Routing AS Number, interkoneksi VLAN multi-switch, atau kontrak pemeliharaan berkala, tim kami siap berdiskusi langsung.
                </p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-primary whitespace-nowrap shrink-0">
                Konsultasikan Kebutuhan Khusus
            </a>
        </div>
    </div>
</section>

{{-- 4. FAQ Mengenai Harga & Garansi --}}
@if($faqs->isNotEmpty())
<section class="section bg-white border-t border-slate-200/80" aria-labelledby="faq-pricing-title">
    <div class="wrap max-w-4xl">
        <div class="text-left mb-10">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-700">FAQ Biaya &amp; Garansi</span>
            <h2 id="faq-pricing-title" class="mt-2 text-2xl sm:text-3xl font-extrabold text-navy-900 leading-tight">
                Pertanyaan Seputar Pembayaran &amp; Layanan
            </h2>
        </div>

        <div class="space-y-3">
            @foreach($faqs as $faq)
                <div class="rounded-xl border border-slate-200 bg-surface p-5">
                    <details class="group">
                        <summary class="flex justify-between items-center cursor-pointer font-bold text-navy-900 text-base list-none gap-4">
                            <span>{{ $faq->question }}</span>
                            <x-icon name="chevron-down" class="h-4 w-4 text-slate-500 transition-transform group-open:rotate-180 shrink-0" />
                        </summary>
                        <div class="mt-3 pt-3 border-t border-slate-200/70 text-slate-600 text-sm leading-relaxed">
                            <p class="whitespace-pre-line">{{ $faq->answer }}</p>
                        </div>
                    </details>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- 5. CTA WhatsApp --}}
<section class="section-compact bg-navy-900 text-white">
    <div class="wrap text-center">
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight sm:text-4xl">
            Belum Yakin Paket Mana yang Cocok?
        </h2>
        <p class="mx-auto mt-3 max-w-2xl text-sm sm:text-base text-slate-300 leading-relaxed">
            Sampaikan kebutuhan dan jumlah pengguna jaringan Anda kepada kami. Kami akan merekomendasikan paket yang paling hemat dan tepat guna.
        </p>
        <div class="mt-7 flex justify-center">
            <a href="{{ $waLink('Halo, saya ingin konsultasi memilih paket setting MikroTik yang tepat.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-lg">
                <x-icon name="whatsapp" class="h-5 w-5" />
                <span>Konsultasi Paket via WhatsApp</span>
            </a>
        </div>
    </div>
</section>
@endsection
