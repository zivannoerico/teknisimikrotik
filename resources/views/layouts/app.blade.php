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
                        {{-- Dropdown Layanan Compact 2-Kolom --}}
                        <div class="relative group/nav" id="desktop-services-dropdown">
                            <button type="button"
                                    id="desktop-services-trigger"
                                    class="nav-link inline-flex items-center gap-1.5 cursor-pointer {{ request()->routeIs('services.*') ? 'text-brand-700 font-bold bg-brand-50' : '' }}"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                    aria-controls="services-menu-dropdown">
                                <span>Layanan</span>
                                <x-icon name="chevron-down" id="desktop-services-chevron" class="h-3.5 w-3.5 transition-transform duration-200 group-hover/nav:rotate-180 group-focus-within/nav:rotate-180 group-[.is-open]/nav:rotate-180 text-slate-500" />
                            </button>

                            {{-- Invisible hover bridge & 2-column compact dropdown panel (w-[500px]) --}}
                            <div class="absolute left-0 top-full pt-2 w-[500px] transition-all duration-200 opacity-0 pointer-events-none translate-y-2 group-hover/nav:opacity-100 group-hover/nav:pointer-events-auto group-hover/nav:translate-y-0 group-focus-within/nav:opacity-100 group-focus-within/nav:pointer-events-auto group-focus-within/nav:translate-y-0 group-[.is-open]/nav:opacity-100 group-[.is-open]/nav:pointer-events-auto group-[.is-open]/nav:translate-y-0 z-50">
                                <div id="services-menu-dropdown" class="bg-white rounded-2xl border border-slate-200/90 shadow-xl p-3 grid grid-cols-2 gap-1 text-left">
                                    @php
                                        $chunks = $navServices->chunk(5);
                                    @endphp
                                    <div class="space-y-0.5">
                                        @foreach($chunks->get(0, collect()) as $s)
                                            <a href="{{ route('services.show', $s->slug) }}"
                                               class="group/item flex items-start gap-2.5 p-2 rounded-xl hover:bg-slate-50 transition-colors {{ request()->is('layanan/'.$s->slug) ? 'bg-blue-50/70 text-blue-700 font-semibold' : 'text-slate-800' }}">
                                                <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-700 transition-colors group-hover/item:bg-blue-600 group-hover/item:text-white">
                                                    @if(str_contains($s->slug, 'load-balancing'))
                                                        <x-icon name="network" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'bandwidth') || str_contains($s->slug, 'qos'))
                                                        <x-icon name="gauge" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'hotspot'))
                                                        <x-icon name="wifi" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'vpn') || str_contains($s->slug, 'firewall'))
                                                        <x-icon name="shield" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'vlan'))
                                                        <x-icon name="layers" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'maintenance') || str_contains($s->slug, 'monitoring'))
                                                        <x-icon name="clock" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'dasar') || str_contains($s->slug, 'awal'))
                                                        <x-icon name="cpu" class="h-3.5 w-3.5" />
                                                    @else
                                                        <x-icon name="topology" class="h-3.5 w-3.5" />
                                                    @endif
                                                </span>
                                                <div class="min-w-0 flex-1">
                                                    <span class="text-xs font-semibold leading-snug block group-hover/item:text-blue-700 transition-colors">
                                                        {{ $s->title }}
                                                    </span>
                                                    @if(!empty($s->price_start))
                                                        <span class="text-[10px] text-slate-400 block font-mono">Mulai {{ $s->price_start }}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>

                                    <div class="space-y-0.5 border-l border-slate-100 pl-1">
                                        @foreach($chunks->get(1, collect()) as $s)
                                            <a href="{{ route('services.show', $s->slug) }}"
                                               class="group/item flex items-start gap-2.5 p-2 rounded-xl hover:bg-slate-50 transition-colors {{ request()->is('layanan/'.$s->slug) ? 'bg-blue-50/70 text-blue-700 font-semibold' : 'text-slate-800' }}">
                                                <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-700 transition-colors group-hover/item:bg-blue-600 group-hover/item:text-white">
                                                    @if(str_contains($s->slug, 'load-balancing'))
                                                        <x-icon name="network" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'bandwidth') || str_contains($s->slug, 'qos'))
                                                        <x-icon name="gauge" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'hotspot'))
                                                        <x-icon name="wifi" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'vpn') || str_contains($s->slug, 'firewall'))
                                                        <x-icon name="shield" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'vlan'))
                                                        <x-icon name="layers" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'maintenance') || str_contains($s->slug, 'monitoring'))
                                                        <x-icon name="clock" class="h-3.5 w-3.5" />
                                                    @elseif(str_contains($s->slug, 'dasar') || str_contains($s->slug, 'awal'))
                                                        <x-icon name="cpu" class="h-3.5 w-3.5" />
                                                    @else
                                                        <x-icon name="topology" class="h-3.5 w-3.5" />
                                                    @endif
                                                </span>
                                                <div class="min-w-0 flex-1">
                                                    <span class="text-xs font-semibold leading-snug block group-hover/item:text-blue-700 transition-colors">
                                                        {{ $s->title }}
                                                    </span>
                                                    @if(!empty($s->price_start))
                                                        <span class="text-[10px] text-slate-400 block font-mono">Mulai {{ $s->price_start }}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
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
                        <div class="border-b border-slate-100">
                            <button type="button"
                                    id="mobile-services-button"
                                    class="flex items-center justify-between w-full min-h-[3rem] px-2 text-left font-heading text-base font-bold text-navy-900 select-none cursor-pointer"
                                    aria-expanded="false"
                                    aria-controls="mobile-services-submenu">
                                <span class="{{ request()->routeIs('services.*') ? 'text-blue-700' : '' }}">Layanan</span>
                                <x-icon name="chevron-down" id="mobile-services-chevron" class="h-4 w-4 text-slate-400 transition-transform duration-200" />
                            </button>
                            <div id="mobile-services-submenu" hidden class="pb-3 pt-1 space-y-1 pl-2">
                                @foreach($navServices as $s)
                                    <a href="{{ route('services.show', $s->slug) }}"
                                       class="flex items-center justify-between py-2 px-3 rounded-lg text-xs font-semibold text-slate-700 hover:text-blue-700 hover:bg-slate-50 transition-colors {{ request()->is('layanan/'.$s->slug) ? 'bg-blue-50 text-blue-700' : '' }}">
                                        <span class="truncate pr-2">{{ $s->title }}</span>
                                        @if(!empty($s->price_start))
                                            <span class="text-[10px] text-slate-400 font-mono shrink-0">{{ $s->price_start }}</span>
                                        @endif
                                    </a>
                                @endforeach
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
