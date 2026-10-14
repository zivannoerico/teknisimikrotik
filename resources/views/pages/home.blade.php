@extends('layouts.app')

@section('title', 'Jasa Setting MikroTik & Manajemen Jaringan Profesional')
@section('meta_description', 'Jaringan lambat & sering putus? Kami bantu optimalkan jaringan MikroTik Anda dengan solusi manajemen bandwidth, multi-ISP failover, dan keamanan koneksi.')

@php
    $portfolioLabel = array_key_exists('portfolio_label', $siteSettings) ? $siteSettings['portfolio_label'] : 'Contoh Proyek';
    $featuredPlanId = $plans->firstWhere('is_popular', true)?->id;

    // Fallback data if DB returns empty collections so sections are NEVER empty
    if ($featuredServices->isEmpty()) {
        $featuredServices = collect([
            (object)[
                'title' => 'Multi-ISP Load Balancing & Failover',
                'slug' => 'multi-isp-load-balancing-failover',
                'short_description' => 'Gabungkan 2 atau lebih jalur ISP untuk kecepatan optimal dan otomatis beralih tanpa jeda jika satu jalur penyedia internet mengalami gangguan.',
                'features' => ['Metode PCC / ECMP Load Balancing', 'Deteksi ISP Down otomatis (< 2 detik)', 'Pisah traffic browsing & aplikasi bisnis'],
                'price_start' => 'Rp 450.000',
            ],
            (object)[
                'title' => 'Bandwidth Management & QoS Prioritas',
                'slug' => 'bandwidth-management-qos',
                'short_description' => 'Atur jatah bandwidth secara adil, prioritaskan aplikasi kritis seperti Zoom meeting dan ERP kantor, serta batasi unduhan streaming berlebih.',
                'features' => ['Prioritas traffic Zoom, ERP & VoIP', 'Queue Tree hierarkis & Simple Queue', 'Batas kecepatan per departemen / IP'],
                'price_start' => 'Rp 350.000',
            ],
            (object)[
                'title' => 'Sistem Hotspot & Billing Voucher Cafe/Hotel',
                'slug' => 'hotspot-billing-voucher',
                'short_description' => 'Template login page modern responsif dengan brand usaha Anda, integrasi manajemen voucher Mikhmon, limitasi waktu atau kuota, dan isolasi keamanan pengguna.',
                'features' => ['Login page responsif custom logo', 'Integrasi Mikhmon online / offline', 'Limitasi jam, hari, atau kuota data'],
                'price_start' => 'Rp 500.000',
            ],
        ]);
    }

    if ($plans->isEmpty()) {
        $plans = collect([
            (object)[
                'id' => 1,
                'name' => 'Paket Basic / Rumah / Kos',
                'formatted_price' => 'Rp 350.000',
                'billing_period' => 'sekali setting',
                'description' => 'Cocok untuk rumah tinggal, kos-kosan kecil (1-15 kamar), atau toko retail dengan 1 jalur ISP.',
                'features' => ['Setting 1 ISP (DHCP / PPPoE Client / Static)', 'Konfigurasi DHCP Server & DNS Caching', 'Simple Queue Bandwidth Management adil', 'Firewall dasar & amankan service Winbox', 'Garansi remote & revisi 7 hari'],
                'is_popular' => false,
            ],
            (object)[
                'id' => 2,
                'name' => 'Paket Bisnis & Multi-ISP',
                'formatted_price' => 'Rp 650.000',
                'billing_period' => 'sekali setting',
                'description' => 'Pilihan utama kantor operasional, cafe, klinik, dan bisnis yang membutuhkan internet stabil tanpa jeda.',
                'features' => ['Load Balancing 2-3 ISP (Metode PCC akurat)', 'Otomatis Failover (Auto pindah jika ISP drop)', 'Pisah traffic Browsing, Streaming, Game/VoIP', 'Queue Tree bandwidth prioritas Zoom/ERP', 'Garansi pengerjaan & monitoring 14 hari'],
                'is_popular' => true,
            ],
            (object)[
                'id' => 3,
                'name' => 'Paket Enterprise & Antar Cabang',
                'formatted_price' => 'Rp 1.250.000',
                'billing_period' => 'sekali setting',
                'description' => 'Dirancang untuk perusahaan multi-cabang, pabrik, hotel berbintang, dan institusi pendidikan.',
                'features' => ['Semua fitur Paket Bisnis & Multi-ISP', 'Setup VPN Inter-Branch (WireGuard / IPSec / OSPF)', 'Hotspot login page branding + Mikhmon voucher', 'VLAN Management isolasi divisi kerja', 'Garansi pendampingan penuh 30 hari'],
                'is_popular' => false,
            ],
        ]);
        $featuredPlanId = 2;
    }

    if ($portfolios->isEmpty()) {
        $portfolios = collect([
            (object)[
                'title' => 'Optimalisasi Jaringan & Failover 3 ISP PT. Surya Logistik Makmur',
                'slug' => 'optimalisasi-failover-pt-surya-logistik',
                'category' => 'Perkantoran',
                'challenge' => 'Sistem monitoring logistik real-time sering offline saat salah satu provider gangguan, dan kecepatan download driver mengganggu meeting direksi.',
                'solution' => 'Menggunakan MikroTik CCR2004-16G-2S+, menerapkan load balancing PCC 3 ISP dengan script failover rekursif, serta Queue Tree prioritas tinggi untuk traffic ERP & Zoom.',
                'result' => 'Uptime operasional mencapai 99.98%, keluhan meeting patah-patah turun drastis 0%, staf dapat bekerja tanpa gangguan pergantian jalur.',
                'image_url' => asset('images/portfolio/portfolio-office.webp'),
            ],
            (object)[
                'title' => 'Sistem Hotspot Login & Voucher Terpadu Grand Palace Hotel & Convention',
                'slug' => 'hotspot-voucher-grand-palace-hotel',
                'category' => 'Perhotelan',
                'challenge' => 'Tamu mengeluh sinyal lambat akibat ada yang menggunakan download torrent tanpa batas, serta proses login lambat.',
                'solution' => 'Konfigurasi MikroTik RB4011iGS+, custom responsive landing page dengan logo hotel, rate limit per user 10 Mbps, dan isolasi client agar antar tamu tidak dapat saling intip.',
                'result' => 'Review kepuasan WiFi tamu di OTA naik dari rating 3.2 ke 4.8 bintang, pemakaian bandwidth terkontrol rata.',
                'image_url' => asset('images/portfolio/portfolio-hotel.webp'),
            ],
        ]);
    }
@endphp

@section('content')

{{-- 1. HERO SECTION (Minimalis, Clean, Gambar Router Langsung Tanpa Panel Dashboard) --}}
<section class="relative overflow-hidden bg-white py-14 sm:py-18 lg:py-20" aria-labelledby="hero-title">
    <div class="wrap relative">
        <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-12">
            {{-- Kolom Kiri: Headline, Subheadline & CTA --}}
            <div class="lg:col-span-7">
                <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                    Jasa Setting MikroTik &amp; Manajemen Jaringan
                </span>

                <h1 id="hero-title" class="mt-4 text-3xl font-extrabold tracking-tight text-navy-900 sm:text-4xl lg:text-[2.875rem] lg:leading-[1.15]">
                    @if(!empty($siteSettings['hero_title']))
                        @php
                            $heroTitle = $siteSettings['hero_title'];
                            $parts = preg_split('/(\?|\|)/', $heroTitle, 2, PREG_SPLIT_DELIM_CAPTURE);
                        @endphp
                        @if(count($parts) >= 3 && trim($parts[2]) !== '')
                            {{ trim($parts[0]) }}{{ $parts[1] }}
                            <span class="mt-2.5 block text-xl font-bold text-blue-600 sm:text-2xl lg:text-[1.625rem] lg:leading-snug">
                                {{ trim($parts[2]) }}
                            </span>
                        @else
                            {{ $heroTitle }}
                        @endif
                    @else
                        Jaringan Lambat &amp; Sering Putus?
                        <span class="mt-2.5 block text-xl font-bold text-blue-600 sm:text-2xl lg:text-[1.625rem] lg:leading-snug">
                            Kami Bantu Optimalkan Jaringan MikroTik Anda.
                        </span>
                    @endif
                </h1>

                <p class="mt-4 max-w-xl text-base leading-relaxed text-slate-600 sm:text-[1.0625rem]">
                    {{ !empty($siteSettings['hero_subtitle']) ? $siteSettings['hero_subtitle'] : 'Solusi konfigurasi jaringan yang disesuaikan dengan kebutuhan bisnis Anda, mulai dari manajemen bandwidth hingga keamanan dan kestabilan koneksi.' }}
                </p>

                <div class="mt-7 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                    <a href="{{ $waLink('Halo, saya ingin konsultasi masalah jaringan.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-lg">
                        <x-icon name="whatsapp" class="h-5 w-5" />
                        <span>Konsultasi Gratis</span>
                    </a>
                    <a href="#layanan" class="btn btn-outline btn-lg">
                        <span>Lihat Layanan</span>
                        <x-icon name="arrow-right" class="h-4 w-4 text-slate-500" />
                    </a>
                </div>
            </div>

            {{-- Kolom Kanan: Visual Perangkat Router MikroTik Langsung Tanpa Panel Dashboard --}}
            <div class="lg:col-span-5 flex items-center justify-center lg:justify-end">
                <img src="{{ asset('images/hero-router.webp') }}"
                     alt="Router MikroTik Profesional untuk jaringan bisnis yang stabil dan terkelola"
                     width="520" height="240"
                     class="h-auto w-full max-w-[24rem] lg:max-w-md object-contain drop-shadow-md rounded-2xl"
                     fetchpriority="high">
            </div>
        </div>
    </div>
</section>

{{-- 2. MASALAH YANG SERING DIALAMI --}}
<section class="section border-t border-slate-200/80 bg-white" aria-labelledby="masalah-title">
    <div class="wrap">
        {{-- Section Header Rata Kiri --}}
        <div class="max-w-2xl text-left">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                Kendala Lapangan
            </span>
            <h2 id="masalah-title" class="mt-3 text-2xl sm:text-3xl lg:text-[2.25rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Jaringan Anda Mengalami Masalah Ini?
            </h2>
            <p class="mt-2 text-sm sm:text-base leading-relaxed text-slate-600">
                Masalah jaringan yang tidak ditangani dengan tepat dapat mengganggu produktivitas dan operasional bisnis.
            </p>
        </div>

        {{-- 4 Kolom Masalah Minimalis & Rapi --}}
        <div class="mt-10 lg:mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-surface p-6 shadow-2xs">
                <div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700">
                        <x-icon name="gauge" class="h-5 w-5" />
                    </div>
                    <h3 class="mt-4 text-base sm:text-lg font-bold text-navy-900 leading-snug">
                        Internet Lambat dan Tidak Stabil
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Koneksi melambat atau sering terputus saat digunakan untuk bekerja dan menjalankan operasional.
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-surface p-6 shadow-2xs">
                <div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700">
                        <x-icon name="network" class="h-5 w-5" />
                    </div>
                    <h3 class="mt-4 text-base sm:text-lg font-bold text-navy-900 leading-snug">
                        Bandwidth Habis oleh Satu Pengguna
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Penggunaan bandwidth yang tidak terkontrol membuat pengguna lain mengalami koneksi lambat.
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-surface p-6 shadow-2xs">
                <div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700">
                        <x-icon name="wifi" class="h-5 w-5" />
                    </div>
                    <h3 class="mt-4 text-base sm:text-lg font-bold text-navy-900 leading-snug">
                        Hotspot Sering Error
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Pengguna kesulitan terhubung, login bermasalah, atau voucher hotspot tidak berjalan sebagaimana mestinya.
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-surface p-6 shadow-2xs">
                <div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700">
                        <x-icon name="shield" class="h-5 w-5" />
                    </div>
                    <h3 class="mt-4 text-base sm:text-lg font-bold text-navy-900 leading-snug">
                        Jaringan Rawan Gangguan Keamanan
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Konfigurasi firewall dan pengaturan akses yang kurang tepat dapat meningkatkan risiko gangguan keamanan jaringan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. LAYANAN JARINGAN --}}
<section id="layanan" class="section border-t border-slate-200/80 bg-surface" aria-labelledby="layanan-title">
    <div class="wrap">
        {{-- Section Header Rata Kiri dengan Hierarki Baru --}}
        <div class="max-w-2xl text-left">
            <h2 id="layanan-title" class="text-2xl sm:text-3xl lg:text-[2.25rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Layanan Jaringan
            </h2>
            <p class="mt-2 text-sm sm:text-base font-medium text-slate-700">
                Tiga Layanan yang Paling Sering Digunakan
            </p>
            <p class="mt-0.5 text-sm sm:text-base leading-relaxed text-slate-600">
                Solusi jaringan untuk membantu bisnis Anda tetap stabil, aman, dan terkelola.
            </p>
        </div>

        {{-- 3 Kolom Terbuka Tanpa Kotak Card --}}
        <div class="mt-10 lg:mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3 lg:gap-10">
            @foreach ($featuredServices->take(3) as $index => $service)
                <div class="flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-700 shrink-0">
                                @if(str_contains($service->slug, 'load-balancing'))
                                    <x-icon name="network" class="h-5 w-5" />
                                @elseif(str_contains($service->slug, 'bandwidth') || str_contains($service->slug, 'qos'))
                                    <x-icon name="gauge" class="h-5 w-5" />
                                @elseif(str_contains($service->slug, 'hotspot'))
                                    <x-icon name="wifi" class="h-5 w-5" />
                                @else
                                    <x-icon name="topology" class="h-5 w-5" />
                                @endif
                            </span>
                            @if (!empty($service->price_start))
                                <span class="rounded-md bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-700">
                                    Mulai {{ $service->price_start }}
                                </span>
                            @endif
                        </div>

                        <h3 class="mt-4 text-lg sm:text-xl font-bold leading-snug text-navy-900">
                            {{ $service->title }}
                        </h3>

                        <p class="mt-2 text-sm sm:text-base leading-relaxed text-slate-600">
                            {{ $service->short_description }}
                        </p>

                        @if (!empty($service->features))
                            <ul class="mt-3.5 space-y-2 text-sm text-slate-700">
                                @foreach (array_slice($service->features, 0, 3) as $item)
                                    <li class="flex items-start gap-2">
                                        <x-icon name="check" class="mt-0.5 h-3.5 w-3.5 shrink-0 text-blue-600" />
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="pt-1.5">
                        <a href="{{ route('services.show', $service->slug ?? '#') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-700 hover:text-navy-900 transition-colors">
                            <span>Lihat Detail Layanan</span>
                            <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- 4. CARA KERJA KAMI --}}
<section class="section border-t border-slate-200/80 bg-white" aria-labelledby="cara-kerja-title">
    <div class="wrap">
        {{-- Section Header Rata Kiri --}}
        <div class="max-w-2xl text-left">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                Alur Transparan
            </span>
            <h2 id="cara-kerja-title" class="mt-3 text-2xl sm:text-3xl lg:text-[2.25rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Cara Kerja Kami
            </h2>
            <p class="mt-2 text-sm sm:text-base leading-relaxed text-slate-600">
                Proses yang jelas, mulai dari memahami kebutuhan hingga jaringan siap digunakan.
            </p>
        </div>

        {{-- 4 Langkah Horizontal yang Rapi --}}
        <div class="mt-10 lg:mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-surface p-6 shadow-2xs">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-blue-700 bg-blue-100/70 px-2.5 py-0.5 rounded-md">01</span>
                        <span class="text-blue-600">
                            <x-icon name="chat" class="h-4 w-4" />
                        </span>
                    </div>
                    <h3 class="mt-4 text-base sm:text-lg font-bold text-navy-900 leading-snug">
                        Konsultasi
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Kami memahami kendala, kebutuhan, dan kondisi awal jaringan yang ingin Anda tangani.
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-surface p-6 shadow-2xs">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-blue-700 bg-blue-100/70 px-2.5 py-0.5 rounded-md">02</span>
                        <span class="text-blue-600">
                            <x-icon name="search" class="h-4 w-4" />
                        </span>
                    </div>
                    <h3 class="mt-4 text-base sm:text-lg font-bold text-navy-900 leading-snug">
                        Survei dan Analisis
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Kami mempelajari topologi, perangkat, kebutuhan bandwidth, dan kondisi jaringan untuk menentukan solusi yang sesuai. Survei dilakukan sesuai kebutuhan dan kesepakatan dengan pelanggan.
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-surface p-6 shadow-2xs">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-blue-700 bg-blue-100/70 px-2.5 py-0.5 rounded-md">03</span>
                        <span class="text-blue-600">
                            <x-icon name="cpu" class="h-4 w-4" />
                        </span>
                    </div>
                    <h3 class="mt-4 text-base sm:text-lg font-bold text-navy-900 leading-snug">
                        Pengerjaan
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Konfigurasi dan penanganan dilakukan secara remote atau onsite sesuai kebutuhan, akses yang tersedia, dan kesepakatan pengerjaan.
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-surface p-6 shadow-2xs">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-blue-700 bg-blue-100/70 px-2.5 py-0.5 rounded-md">04</span>
                        <span class="text-blue-600">
                            <x-icon name="shield" class="h-4 w-4" />
                        </span>
                    </div>
                    <h3 class="mt-4 text-base sm:text-lg font-bold text-navy-900 leading-snug">
                        Serah Terima dan Garansi
                    </h3>
                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600">
                        Setelah pengerjaan, pelanggan menerima penjelasan konfigurasi dan dokumentasi yang relevan. Informasi garansi atau pendampingan mengikuti ketentuan layanan yang benar-benar berlaku.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 5. MENGAPA MEMILIH TEKNISIMIKROTIK? --}}
<section class="section-compact bg-navy-900 text-white" aria-labelledby="mengapa-title">
    <div class="wrap">
        {{-- Baris Pertama: Judul Dua Baris Rata Kiri --}}
        <div class="mb-10 lg:mb-12 text-left">
            <h2 id="mengapa-title" class="max-w-md text-2xl sm:text-3xl lg:text-[2.25rem] font-bold tracking-tight text-white leading-[1.2]">
                <span class="block">Mengapa Memilih</span>
                <span class="block">TeknisiMikrotik?</span>
            </h2>
        </div>

        {{-- Baris Kedua: 4 Teks Keunggulan yang Rapi, Seimbang, dan Berjarak Proporsional --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10 xl:gap-12">
            <div>
                <div class="mb-3.5 text-blue-400">
                    <x-icon name="search" class="h-6 w-6" />
                </div>
                <h3 class="text-base sm:text-lg font-bold text-white tracking-tight">
                    Analisis Kebutuhan Jaringan
                </h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-300">
                    Kami pelajari topologi fisik, jenis ISP, dan pola traffic pengguna sebelum merekomendasikan konfigurasi yang tepat.
                </p>
            </div>

            <div>
                <div class="mb-3.5 text-blue-400">
                    <x-icon name="cpu" class="h-6 w-6" />
                </div>
                <h3 class="text-base sm:text-lg font-bold text-white tracking-tight">
                    Konfigurasi Sesuai Kebutuhan
                </h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-300">
                    Setting RouterOS disesuaikan spesifik dengan arsitektur dan kebutuhan bandwidth Anda, bukan sekadar template instan.
                </p>
            </div>

            <div>
                <div class="mb-3.5 text-blue-400">
                    <x-icon name="chat" class="h-6 w-6" />
                </div>
                <h3 class="text-base sm:text-lg font-bold text-white tracking-tight">
                    Proses Pengerjaan Terbuka
                </h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-300">
                    Setiap tahap pengerjaan remote maupun onsite dijelaskan secara transparan tanpa pengaturan tersembunyi.
                </p>
            </div>

            <div>
                <div class="mb-3.5 text-blue-400">
                    <x-icon name="shield" class="h-6 w-6" />
                </div>
                <h3 class="text-base sm:text-lg font-bold text-white tracking-tight">
                    Pendampingan &amp; Dokumentasi
                </h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-300">
                    Serah terima disertai dokumentasi parameter, backup script, dan masa pendampingan uji coba beban operasional.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- 6. PAKET DAN HARGA --}}
<section id="paket" class="section bg-white" aria-labelledby="paket-title">
    <div class="wrap">
        {{-- Section Header dengan Tombol di Kanan Atas --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-2xl text-left">
                <h2 id="paket-title" class="text-2xl sm:text-3xl lg:text-[2.125rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                    Paket &amp; Harga Konfigurasi
                </h2>
                <p class="mt-2 text-sm sm:text-base leading-relaxed text-slate-600">
                    Pilih paket sesuai skala jaringan dan kebutuhan Anda. Kebutuhan custom dapat didiskusikan terlebih dahulu.
                </p>
            </div>
            <div class="shrink-0">
                <a href="{{ route('pricing') }}" class="group inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-navy-900 shadow-2xs transition-all hover:border-navy-900 hover:bg-slate-50 hover:shadow-xs">
                    <span>Lihat Semua Paket</span>
                    <x-icon name="arrow-right" class="h-4 w-4 text-slate-400 transition-transform group-hover:translate-x-1 group-hover:text-navy-900" />
                </a>
            </div>
        </div>

        {{-- 3 Kartu Paket Terisi Lengkap (Dipertahankan 100%) --}}
        <div class="mt-10 lg:mt-12 grid items-stretch gap-6 lg:grid-cols-3">
            @foreach ($plans->take(3) as $plan)
                @php $isFeatured = $plan->id === $featuredPlanId; @endphp
                <article class="flex flex-col justify-between rounded-2xl border p-6 sm:p-7 transition-all {{ $isFeatured
                    ? 'border-blue-600 bg-white shadow-lg ring-1 ring-blue-600 relative lg:-my-2'
                    : 'border-slate-200 bg-white hover:border-slate-300' }}">

                    <div>
                        @if ($isFeatured)
                            <div class="mb-3.5">
                                <span class="inline-flex rounded-full bg-blue-50 px-3 py-0.5 text-xs font-bold uppercase tracking-wider text-blue-700">
                                    Paling Populer
                                </span>
                            </div>
                        @endif

                        <h3 class="text-xl font-bold leading-tight text-navy-900">{{ $plan->name }}</h3>

                        <div class="mt-3.5 flex flex-wrap items-baseline gap-x-2 gap-y-1">
                            <span class="font-heading text-2xl sm:text-3xl lg:text-[1.75rem] xl:text-3xl font-extrabold tracking-tight text-navy-900 whitespace-nowrap">
                                {{ $plan->formatted_price ?? 'Hubungi Kami' }}
                            </span>
                            @if (!empty($plan->billing_period))
                                <span class="text-xs sm:text-sm text-slate-500 font-medium whitespace-nowrap">/ {{ $plan->billing_period }}</span>
                            @endif
                        </div>

                        @if (!empty($plan->description))
                            <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $plan->description }}</p>
                        @endif

                        {{-- Features List --}}
                        <div class="mt-5 border-t border-slate-100 pt-5">
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Cakupan Layanan:</p>
                            <ul class="mt-3 space-y-2.5 text-xs sm:text-sm text-slate-700">
                                @foreach (array_slice($plan->features ?? [], 0, 5) as $feature)
                                    <li class="flex items-start gap-2.5">
                                        <x-icon name="check" class="mt-0.5 h-3.5 w-3.5 shrink-0 text-blue-600" />
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="{{ $waLink('Halo, saya tertarik dengan '.$plan->name.'. Bisa dijelaskan detailnya?') }}"
                           target="_blank" rel="noopener noreferrer"
                           class="btn btn-block {{ $isFeatured ? 'btn-wa' : 'btn-outline' }}">
                            <x-icon name="whatsapp" class="h-4 w-4" />
                            <span>Tanya Paket Ini</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>

{{-- 7. PORTOFOLIO PENGERJAAN --}}
@if ($portfolios->isNotEmpty())
<section id="portofolio" class="section border-t border-slate-200/80 bg-surface" aria-labelledby="portofolio-title">
    <div class="wrap">
        {{-- Section Header dengan Tombol di Kanan Atas --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-2xl text-left">
                <h2 id="portofolio-title" class="text-2xl sm:text-3xl lg:text-[2.125rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                    Portofolio Pengerjaan
                </h2>
                <p class="mt-2 text-sm sm:text-base leading-relaxed text-slate-600">
                    Contoh pengerjaan dan solusi untuk berbagai kebutuhan jaringan.
                </p>
            </div>
            <div class="shrink-0">
                <a href="{{ route('portfolios.index') }}" class="group inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-navy-900 shadow-2xs transition-all hover:border-navy-900 hover:bg-slate-50 hover:shadow-xs">
                    <span>Lihat Semua Portofolio</span>
                    <x-icon name="arrow-right" class="h-4 w-4 text-slate-400 transition-transform group-hover:translate-x-1 group-hover:text-navy-900" />
                </a>
            </div>
        </div>

        {{-- 2 Studi Kasus: Daftar Bersih Tanpa Nested Cards --}}
        <div class="mt-10 lg:mt-12 space-y-10 lg:space-y-12">
            @foreach ($portfolios->take(2) as $portfolio)
                <div class="grid items-center gap-8 lg:grid-cols-12 lg:gap-10 pt-8 first:pt-0 border-t border-slate-200/70 first:border-t-0">
                    {{-- Visual Topologi --}}
                    <div class="lg:col-span-5 {{ $loop->even ? 'lg:order-2' : '' }}">
                        @if (!empty($portfolio->image_url))
                            <div class="aspect-[16/10] sm:aspect-[4/3] w-full flex items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white p-3.5 shadow-2xs">
                                <img src="{{ $portfolio->image_url }}"
                                     width="760" height="540" loading="lazy"
                                     alt="Diagram topologi jaringan: {{ $portfolio->title }}"
                                     class="h-full w-full object-contain">
                            </div>
                        @else
                            <div class="aspect-[16/10] sm:aspect-[4/3] w-full flex items-center justify-center rounded-2xl border border-slate-200 bg-white p-3.5 text-slate-300">
                                <x-icon name="router" class="h-12 w-12" />
                            </div>
                        @endif
                    </div>

                    {{-- Detail Proyek --}}
                    <div class="lg:col-span-7 {{ $loop->even ? 'lg:order-1' : '' }} space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="rounded-full bg-blue-50 px-3 py-0.5 text-xs font-bold text-blue-700">
                                {{ $portfolio->category }}
                            </span>
                            @if ($portfolioLabel)
                                <span class="text-xs font-medium text-slate-500">&middot; {{ $portfolioLabel }}</span>
                            @endif
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold leading-snug text-navy-900">
                            {{ $portfolio->title }}
                        </h3>

                        {{-- Masalah & Solusi sebagai Teks Bersih --}}
                        <div class="space-y-3 text-sm leading-relaxed pt-1">
                            @if (!empty($portfolio->challenge))
                                <div>
                                    <span class="font-bold text-xs uppercase tracking-wider block text-slate-500 mb-1">Masalah Jaringan:</span>
                                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">{{ \Illuminate\Support\Str::limit($portfolio->challenge, 190) }}</p>
                                </div>
                            @endif
                            @if (!empty($portfolio->solution))
                                <div>
                                    <span class="font-bold text-blue-700 text-xs uppercase tracking-wider block mb-1">Solusi Konfigurasi:</span>
                                    <p class="text-sm sm:text-base text-slate-700 leading-relaxed">{{ \Illuminate\Support\Str::limit($portfolio->solution, 190) }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('portfolios.show', $portfolio->slug ?? '#') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-700 transition-colors hover:text-navy-900">
                                <span>Baca Studi Kasus Selengkapnya</span>
                                <x-icon name="arrow-right" class="h-4 w-4" />
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

</section>
@endif

{{-- 8. CTA PENUTUP & FORMULIR KONSULTASI --}}
<section id="konsultasi" class="section bg-white border-t border-slate-200/80" aria-labelledby="konsultasi-title">
    <div class="wrap">
        <div class="grid items-start gap-10 lg:grid-cols-12 lg:gap-12">
            {{-- Kolom Kiri: Heading & Deskripsi (Tanpa Tombol WA Duplikat) --}}
            <div class="lg:col-span-5 space-y-3 lg:pr-8 lg:border-r lg:border-slate-200/80">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-700">Mulai Diskusi</span>
                <h2 id="konsultasi-title" class="text-2xl sm:text-3xl lg:text-[2.125rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                    Butuh Jaringan yang Lebih Stabil?
                </h2>
                <p class="text-sm sm:text-base leading-relaxed text-slate-600">
                    Ceritakan kendala jaringan Anda. Kami bantu mendiskusikan solusi yang sesuai dengan kebutuhan Anda.
                </p>

                @if (! empty($siteSettings['operational_hours']))
                    <p class="flex items-center gap-2 text-xs text-slate-500 pt-3">
                        <x-icon name="clock" class="h-3.5 w-3.5 text-slate-400 shrink-0" />
                        <span>{{ $siteSettings['operational_hours'] }}</span>
                    </p>
                @endif
            </div>

            {{-- Kolom Kanan: Panel Formulir Bersih Latar Putih --}}
            <div class="lg:col-span-7 bg-white p-2 sm:p-4">
                <div class="mb-4">
                    <h3 class="text-lg sm:text-xl font-bold tracking-tight text-navy-900">Formulir Konsultasi Jaringan</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-0.5">Isi singkat di bawah ini. Tim kami akan segera menghubungi Anda via WhatsApp.</p>
                </div>

                @include('partials.consultation-form', ['serviceOptions' => $serviceOptions, 'formId' => 'home'])
            </div>
        </div>
    </div>
</section>

@endsection
