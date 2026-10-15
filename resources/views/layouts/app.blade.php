@php
    $siteName = $siteSettings['site_name'] ?? 'TEKNISI MIKROTIK';
    $waDisplay = $siteSettings['whatsapp_display'] ?? null;
    $waDefaultMessage = 'Halo, saya ingin konsultasi masalah jaringan.';
    $navItems = [
        ['label' => 'Beranda', 'route' => 'home', 'match' => 'home'],
        ['label' => 'Layanan', 'route' => 'services.index', 'match' => 'services.*'],
        ['label' => 'Paket & Harga', 'route' => 'pricing', 'match' => 'pricing'],
        ['label' => 'Portofolio', 'route' => 'portfolios.index', 'match' => 'portfolios.*'],
        ['label' => 'Tentang', 'route' => 'about', 'match' => 'about'],
        ['label' => 'Blog/Tips', 'route' => 'articles.index', 'match' => 'articles.*'],
        ['label' => 'FAQ', 'route' => 'faq', 'match' => 'faq'],
        ['label' => 'Kontak', 'route' => 'contact', 'match' => 'contact'],
    ];
    $footerExplore = [
        ['label' => 'Beranda', 'route' => 'home'],
        ['label' => 'Layanan Setting', 'route' => 'services.index'],
        ['label' => 'Paket & Harga', 'route' => 'pricing'],
        ['label' => 'Portofolio Project', 'route' => 'portfolios.index'],
    ];
    $footerAbout = [
        ['label' => 'Tentang Kami', 'route' => 'about'],
        ['label' => 'Kontak Kami', 'route' => 'contact'],
        ['label' => 'Form Konsultasi', 'route' => 'consultation.create'],
        ['label' => 'Blog & Tips MikroTik', 'route' => 'articles.index'],
        ['label' => 'Tanya Jawab (FAQ)', 'route' => 'faq'],
    ];
    $metaDescription = trim($__env->yieldContent('meta_description')) ?: 'Jasa setting MikroTik dan manajemen jaringan untuk bisnis, warnet, RT/RW Net, dan kebutuhan jaringan profesional. Konsultasi via WhatsApp.';
    $serviceShortNames = [
        'multi-isp-load-balancing-failover' => 'Load Balancing',
        'bandwidth-management-qos' => 'Manajemen Bandwidth',
        'hotspot-billing-voucher' => 'Hotspot & Voucher',
        'vpn-antar-cabang-remote-access' => 'VPN Jaringan',
        'firewall-hardening-security' => 'Keamanan Firewall',
        'maintenance-jaringan-bulanan' => 'Maintenance Jaringan',
        'setting-dasar-konfigurasi-awal' => 'Konfigurasi RouterOS',
        'vlan-segmentasi-jaringan' => 'VLAN & Segmentasi',
        'rtrw-net-pppoe-server-billing' => 'RT/RW Net & PPPoE',
        'monitoring-telegram-setting-olt' => 'Monitoring & OLT',
    ];
    $getShortTitle = function ($s) use ($serviceShortNames): string {
        return $serviceShortNames[$s->slug] ?? $s->title;
    };
    $getServiceIcon = function ($s): string {
        $slug = $s->slug ?? '';
        if (str_contains($slug, 'load-balancing')) return 'network';
        if (str_contains($slug, 'bandwidth') || str_contains($slug, 'qos')) return 'gauge';
        if (str_contains($slug, 'hotspot')) return 'wifi';
        if (str_contains($slug, 'vpn') || str_contains($slug, 'firewall')) return 'shield';
        if (str_contains($slug, 'vlan')) return 'layers';
        if (str_contains($slug, 'maintenance') || str_contains($slug, 'monitoring')) return 'clock';
        if (str_contains($slug, 'dasar') || str_contains($slug, 'awal')) return 'cpu';
        if (str_contains($slug, 'rtrw')) return 'router';
        return 'topology';
    };
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Jasa Setting MikroTik & Manajemen Jaringan') | {{ $siteName }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="theme-color" content="#0b1f3a">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Jasa Setting MikroTik & Manajemen Jaringan') | {{ $siteName }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/hero-router.webp') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
    <style>
        #desktop-services-dropdown[data-mode="compact"] #services-menu-dropdown {
            width: 380px;
        }
        #desktop-services-dropdown[data-mode="compact"] .services-compact-view {
            display: block;
        }
        #desktop-services-dropdown[data-mode="compact"] .services-expanded-view {
            display: none;
        }

        #desktop-services-dropdown[data-mode="expanded"] #services-menu-dropdown {
            width: 560px;
        }
        #desktop-services-dropdown[data-mode="expanded"] .services-compact-view {
            display: none;
        }
        #desktop-services-dropdown[data-mode="expanded"] .services-expanded-view {
            display: block;
        }
    </style>
</head>
<body class="flex min-h-screen flex-col overflow-x-hidden">
    <a href="#konten" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-lg focus:bg-white focus:px-4 focus:py-3 focus:font-semibold focus:text-navy-900 focus:shadow-lg">Lewati ke konten</a>

    {{-- Header --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/90 bg-white/95 backdrop-blur-md transition-colors">
        <div class="wrap flex h-20 items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="group flex items-center gap-3 rounded-lg focus:outline-none" aria-label="{{ $siteName }} - Beranda">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-navy-900 text-white shadow-sm transition-transform group-hover:scale-105">
                    <x-icon name="topology" class="h-6 w-6" />
                </span>
                <span class="font-heading text-2xl font-bold tracking-tight text-navy-900">
                    Teknisi<span class="text-brand-600">Mikrotik</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 xl:flex" aria-label="Navigasi utama">
                @foreach ($navItems as $item)
                    @if ($item['label'] === 'Layanan')
                        {{-- Dropdown Layanan: Dua Mode Tampilan (Compact & Expanded) --}}
                        <div class="relative group/nav" id="desktop-services-dropdown" data-mode="compact">
                            <button type="button"
                                    id="desktop-services-trigger"
                                    class="nav-link inline-flex items-center gap-1.5 cursor-pointer {{ request()->routeIs('services.*') ? 'text-brand-700 font-bold bg-brand-50' : '' }}"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                    aria-controls="services-menu-dropdown">
                                <span>Layanan</span>
                                <x-icon name="chevron-down" id="desktop-services-chevron" class="h-3.5 w-3.5 transition-transform duration-200 group-hover/nav:rotate-180 group-focus-within/nav:rotate-180 group-[.is-open]/nav:rotate-180 text-slate-500" />
                            </button>

                            {{-- Invisible hover bridge & single dropdown panel that resizes between compact (380px) and expanded (560px) --}}
                            <div id="desktop-services-panel-wrapper"
                                 class="absolute left-0 top-full pt-2 transition-all duration-200 opacity-0 pointer-events-none translate-y-2 group-hover/nav:opacity-100 group-hover/nav:pointer-events-auto group-hover/nav:translate-y-0 group-focus-within/nav:opacity-100 group-focus-within/nav:pointer-events-auto group-focus-within/nav:translate-y-0 group-[.is-open]/nav:opacity-100 group-[.is-open]/nav:pointer-events-auto group-[.is-open]/nav:translate-y-0 z-50">
                                <div id="services-menu-dropdown" class="bg-white rounded-2xl border border-slate-200/90 shadow-xl p-3 text-left transition-[width] duration-200 ease-out">
                                    @php
                                        $chunks = $navServices->chunk(5);
                                    @endphp

                                    {{-- 1. MODE COMPACT: Dua kolom, 5 per kolom, hanya nama singkat --}}
                                    <div class="services-compact-view">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="space-y-1">
                                                @foreach($chunks->get(0, collect()) as $s)
                                                    <a href="{{ route('services.show', $s->slug) }}"
                                                       class="group/item flex items-center px-3 py-2 rounded-xl text-[13px] font-semibold transition-colors {{ request()->is('layanan/'.$s->slug) ? 'bg-blue-50/80 text-blue-700' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                                                        <span class="truncate block">{{ $getShortTitle($s) }}</span>
                                                    </a>
                                                @endforeach
                                            </div>

                                            <div class="space-y-1 border-l border-slate-100 pl-2">
                                                @foreach($chunks->get(1, collect()) as $s)
                                                    <a href="{{ route('services.show', $s->slug) }}"
                                                       class="group/item flex items-center px-3 py-2 rounded-xl text-[13px] font-semibold transition-colors {{ request()->is('layanan/'.$s->slug) ? 'bg-blue-50/80 text-blue-700' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                                                        <span class="truncate block">{{ $getShortTitle($s) }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Tombol Lihat Lainnya di bagian bawah compact --}}
                                        <div class="border-t border-slate-100 mt-2 pt-2 px-1">
                                            <button type="button"
                                                    id="desktop-services-expand-btn"
                                                    class="w-full flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-lg text-xs font-semibold text-slate-500 hover:text-blue-700 hover:bg-slate-50 transition-colors cursor-pointer select-none">
                                                <span>Lihat Lainnya</span>
                                                <x-icon name="chevron-down" class="h-3.5 w-3.5 text-slate-400 group-hover:text-blue-600 transition-colors" />
                                            </button>
                                        </div>
                                    </div>

                                    {{-- 2. MODE EXPANDED: Dua kolom, 5 per kolom, ikon + nama lengkap + harga aktual --}}
                                    <div class="services-expanded-view">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="space-y-1">
                                                @foreach($chunks->get(0, collect()) as $s)
                                                    <a href="{{ route('services.show', $s->slug) }}"
                                                       class="group/item flex items-start gap-2.5 p-2 rounded-xl transition-colors {{ request()->is('layanan/'.$s->slug) ? 'bg-blue-50/80 text-blue-700' : 'text-slate-800 hover:text-blue-700 hover:bg-slate-50' }}">
                                                        <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-700 transition-colors group-hover/item:bg-blue-600 group-hover/item:text-white">
                                                            <x-icon name="{{ $getServiceIcon($s) }}" class="h-4 w-4" />
                                                        </span>
                                                        <div class="min-w-0 flex-1">
                                                            <span class="text-xs font-semibold leading-snug block text-slate-800 group-hover/item:text-blue-700 transition-colors">
                                                                {{ $s->title }}
                                                            </span>
                                                            @if(!empty($s->price_start))
                                                                <span class="text-[11px] text-slate-400 block font-mono mt-0.5">Mulai {{ $s->price_start }}</span>
                                                            @endif
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>

                                            <div class="space-y-1 border-l border-slate-100 pl-2">
                                                @foreach($chunks->get(1, collect()) as $s)
                                                    <a href="{{ route('services.show', $s->slug) }}"
                                                       class="group/item flex items-start gap-2.5 p-2 rounded-xl transition-colors {{ request()->is('layanan/'.$s->slug) ? 'bg-blue-50/80 text-blue-700' : 'text-slate-800 hover:text-blue-700 hover:bg-slate-50' }}">
                                                        <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-700 transition-colors group-hover/item:bg-blue-600 group-hover/item:text-white">
                                                            <x-icon name="{{ $getServiceIcon($s) }}" class="h-4 w-4" />
                                                        </span>
                                                        <div class="min-w-0 flex-1">
                                                            <span class="text-xs font-semibold leading-snug block text-slate-800 group-hover/item:text-blue-700 transition-colors">
                                                                {{ $s->title }}
                                                            </span>
                                                            @if(!empty($s->price_start))
                                                                <span class="text-[11px] text-slate-400 block font-mono mt-0.5">Mulai {{ $s->price_start }}</span>
                                                            @endif
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Tombol Tampilkan Lebih Sedikit di bagian bawah expanded --}}
                                        <div class="border-t border-slate-100 mt-2 pt-2 px-1">
                                            <button type="button"
                                                    id="desktop-services-collapse-btn"
                                                    class="w-full flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-lg text-xs font-semibold text-slate-500 hover:text-blue-700 hover:bg-slate-50 transition-colors cursor-pointer select-none">
                                                <span>Tampilkan Lebih Sedikit</span>
                                                <x-icon name="chevron-up" class="h-3.5 w-3.5 text-slate-400 group-hover:text-blue-600 transition-colors" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route($item['route']) }}" class="nav-link" @if (request()->routeIs($item['match'])) aria-current="page" @endif>{{ $item['label'] }}</a>
                    @endif
                @endforeach
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ $waLink($waDefaultMessage) }}" target="_blank" rel="noopener noreferrer" class="hidden sm:inline-flex h-10 items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 text-sm font-semibold text-white shadow-xs transition-colors hover:bg-emerald-500 whitespace-nowrap">
                    <x-icon name="whatsapp" class="h-4 w-4 shrink-0 text-white" />
                    <span class="leading-none">Konsultasi Gratis</span>
                </a>
                <button type="button" id="mobile-menu-button" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-300 text-navy-900 transition-colors hover:bg-slate-50 xl:hidden" aria-expanded="false" aria-controls="mobile-menu" aria-label="Buka menu navigasi">
                    <x-icon name="menu" id="icon-menu" class="h-5 w-5" />
                    <x-icon name="close" id="icon-close" class="hidden h-5 w-5" />
                </button>
            </div>
        </div>

        <div id="mobile-menu" hidden class="max-h-[calc(100dvh-4.5rem)] overflow-y-auto border-t border-slate-200 bg-white shadow-lg xl:hidden">
            <nav class="wrap py-4" aria-label="Navigasi seluler">
                @foreach ($navItems as $item)
                    @if ($item['label'] === 'Layanan')
                        <div class="border-b border-slate-100" id="mobile-services-container">
                            <button type="button"
                                    id="mobile-services-button"
                                    class="flex items-center justify-between w-full min-h-[3rem] px-2 text-left font-heading text-base font-bold text-navy-900 select-none cursor-pointer"
                                    aria-expanded="false"
                                    aria-controls="mobile-services-submenu">
                                <span class="{{ request()->routeIs('services.*') ? 'text-blue-700' : '' }}">Layanan</span>
                                <x-icon name="chevron-down" id="mobile-services-chevron" class="h-4 w-4 text-slate-400 transition-transform duration-200" />
                            </button>
                            <div id="mobile-services-submenu" hidden class="pb-3 pt-1 pl-2">
                                {{-- Compact mode on mobile: short names only, single column --}}
                                <div id="mobile-services-compact" class="space-y-0.5">
                                    @foreach($navServices as $s)
                                        <a href="{{ route('services.show', $s->slug) }}"
                                           class="flex items-center py-2 px-3 rounded-lg text-xs font-semibold text-slate-700 hover:text-blue-700 hover:bg-slate-50 transition-colors {{ request()->is('layanan/'.$s->slug) ? 'bg-blue-50 text-blue-700' : '' }}">
                                            <span class="truncate">{{ $getShortTitle($s) }}</span>
                                        </a>
                                    @endforeach
                                </div>

                                {{-- Expanded mode on mobile: icons, full titles, prices --}}
                                <div id="mobile-services-expanded" class="space-y-1 hidden">
                                    @foreach($navServices as $s)
                                        <a href="{{ route('services.show', $s->slug) }}"
                                           class="flex items-start gap-2.5 p-2 rounded-lg text-xs font-semibold text-slate-800 hover:text-blue-700 hover:bg-slate-50 transition-colors {{ request()->is('layanan/'.$s->slug) ? 'bg-blue-50 text-blue-700' : '' }}">
                                            <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-700">
                                                <x-icon name="{{ $getServiceIcon($s) }}" class="h-3.5 w-3.5" />
                                            </span>
                                            <div class="min-w-0 flex-1">
                                                <span class="block leading-snug">{{ $s->title }}</span>
                                                @if(!empty($s->price_start))
                                                    <span class="text-[10px] text-slate-400 font-mono mt-0.5 block">Mulai {{ $s->price_start }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                                {{-- Mobile Toggle Button: Lihat Lainnya / Tampilkan Lebih Sedikit --}}
                                <div class="pt-2 px-1">
                                    <button type="button"
                                            id="mobile-services-toggle-btn"
                                            class="w-full flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:text-blue-700 hover:bg-slate-50 transition-colors cursor-pointer select-none">
                                        <span id="mobile-services-toggle-text">Lihat Lainnya</span>
                                        <x-icon name="chevron-down" id="mobile-services-toggle-chevron-down" class="h-3.5 w-3.5 text-slate-400" />
                                        <x-icon name="chevron-up" id="mobile-services-toggle-chevron-up" class="h-3.5 w-3.5 text-slate-400 hidden" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route($item['route']) }}" class="nav-link-mobile" @if (request()->routeIs($item['match'])) aria-current="page" @endif>{{ $item['label'] }}</a>
                    @endif
                @endforeach
                <div class="grid gap-3 pb-4 pt-6">
                    <a href="{{ $waLink($waDefaultMessage) }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-lg btn-block inline-flex items-center justify-center gap-2">
                        <x-icon name="whatsapp" class="h-5 w-5 shrink-0" />
                        <span>Konsultasi Gratis</span>
                    </a>
                    <a href="{{ route('consultation.create') }}" class="btn btn-outline btn-lg btn-block">Isi Formulir Konsultasi</a>
                </div>
            </nav>
        </div>
    </header>

    <main id="konten" class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-navy-900 bg-navy-950 pb-28 pt-16 text-slate-300 sm:pb-16 sm:pt-20">
        <div class="wrap">
            <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-[1.3fr_0.9fr_1fr_1.3fr]">
                <div>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white">
                            <x-icon name="topology" class="h-5 w-5" />
                        </span>
                        <span class="font-heading text-xl font-bold tracking-tight text-white">Teknisi<span class="text-brand-400">Mikrotik</span></span>
                    </a>
                    <p class="mt-4 max-w-sm text-sm sm:text-base leading-relaxed text-slate-300">
                        Solusi setting MikroTik profesional untuk bisnis, kantor, cafe, dan instansi yang membutuhkan jaringan stabil, aman, dan terkontrol.
                    </p>
                </div>

                <div>
                    <h2 class="font-heading text-sm font-bold uppercase tracking-wider text-white">Jelajahi</h2>
                    <ul class="mt-4 grid gap-2.5 text-sm sm:text-base">
                        @foreach ($footerExplore as $item)
                            <li>
                                <a href="{{ route($item['route']) }}" class="text-slate-300 transition-colors hover:text-white">{{ $item['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h2 class="font-heading text-sm font-bold uppercase tracking-wider text-white">Tentang</h2>
                    <ul class="mt-4 grid gap-2.5 text-sm sm:text-base">
                        @foreach ($footerAbout as $item)
                            <li>
                                <a href="{{ route($item['route']) }}" class="text-slate-300 transition-colors hover:text-white">{{ $item['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h2 class="font-heading text-sm font-bold uppercase tracking-wider text-white">Informasi Kontak</h2>
                    <ul class="mt-4 grid gap-3 text-sm sm:text-base text-slate-300">
                        @if ($waDisplay)
                            <li class="flex items-center gap-2.5">
                                <x-icon name="whatsapp" class="h-4 w-4 shrink-0 text-emerald-400" />
                                <a href="{{ $waLink($waDefaultMessage) }}" target="_blank" rel="noopener noreferrer" class="transition-colors hover:text-white font-medium">{{ $waDisplay }}</a>
                            </li>
                        @endif
                        @if (! empty($siteSettings['email']))
                            <li class="flex items-start gap-3">
                                <x-icon name="mail" class="mt-1 h-5 w-5 shrink-0 text-slate-400" />
                                <a href="mailto:{{ $siteSettings['email'] }}" class="break-all transition-colors hover:text-white">{{ $siteSettings['email'] }}</a>
                            </li>
                        @endif
                        @if (! empty($siteSettings['operational_hours']))
                            <li class="flex items-start gap-3">
                                <x-icon name="clock" class="mt-1 h-5 w-5 shrink-0 text-slate-400" />
                                <span>{{ $siteSettings['operational_hours'] }}</span>
                            </li>
                        @endif
                        @if (! empty($siteSettings['address']))
                            <li class="flex items-start gap-3">
                                <x-icon name="pin" class="mt-1 h-5 w-5 shrink-0 text-slate-400" />
                                <span>{{ $siteSettings['address'] }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="mt-16 flex flex-col gap-4 border-t border-white/10 pt-8 text-sm text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p>&copy; {{ date('Y') }} {{ $siteName }}. Seluruh hak cipta dilindungi.</p>
                <a href="{{ route('login') }}" class="transition-colors hover:text-slate-200">Login Admin</a>
            </div>
        </div>
    </footer>

    {{-- Floating WhatsApp (Bottom Right) --}}
    <a href="{{ $waLink($waDefaultMessage) }}" target="_blank" rel="noopener noreferrer" id="wa-float" data-hidden="false"
       class="wa-float group fixed bottom-4 right-4 z-40 flex h-14 w-14 items-center justify-center rounded-full bg-wa-600 text-white shadow-lg sm:bottom-6 sm:right-6"
       aria-label="Chat via WhatsApp" title="Chat via WhatsApp">
        {{-- Animated green pulse & radiating waves --}}
        <span class="wa-ping-ring absolute -inset-1 rounded-full bg-emerald-500/40 pointer-events-none" aria-hidden="true"></span>
        <span class="wa-ping-ring-delayed absolute -inset-2 rounded-full bg-emerald-400/25 pointer-events-none" aria-hidden="true"></span>
        <span class="wa-glow-pulse absolute inset-0 rounded-full bg-emerald-500/45 blur-sm pointer-events-none" aria-hidden="true"></span>
        <x-icon name="whatsapp" class="relative z-10 h-7 w-7 transition-transform group-hover:scale-110" />
    </a>

    {{-- Floating Scroll to Top (Bottom Left) --}}
    <button type="button" id="scroll-to-top" data-visible="false"
       class="scroll-top-btn group fixed bottom-4 left-4 z-40 flex h-14 w-14 items-center justify-center rounded-full border border-slate-700/70 bg-navy-900 text-white shadow-lg transition-all hover:border-slate-500 hover:bg-navy-800 hover:text-brand-300 sm:bottom-6 sm:left-6"
       aria-label="Kembali ke atas" title="Kembali ke atas">
        <x-icon name="arrow-up" class="h-6 w-6 transition-transform group-hover:-translate-y-1" />
    </button>
    @stack('scripts')
</body>
</html>
