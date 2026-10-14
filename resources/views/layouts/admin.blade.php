<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin Panel Teknisi MikroTik</title>
    <meta name="theme-color" content="#0b1f3a">
    <meta name="robots" content="noindex, nofollow">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-full flex bg-slate-50 text-slate-900 antialiased font-sans">

    {{-- Mobile Sidebar Backdrop --}}
    <div id="admin-sidebar-backdrop" class="fixed inset-0 bg-slate-900/50 z-40 lg:hidden hidden transition-opacity"></div>

    {{-- Admin Sidebar (Navy Background with Crisp White & Accent Blue) --}}
    <aside id="admin-sidebar" class="w-64 bg-navy-900 text-slate-300 flex flex-col fixed inset-y-0 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out border-r border-navy-800 shrink-0">
        
        {{-- Sidebar Brand Header --}}
        <div class="h-16 flex items-center px-6 border-b border-navy-800/80 justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group focus:outline-none" title="Lihat Website">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 text-white transition-transform group-hover:scale-105">
                    <x-icon name="topology" class="h-5 w-5" />
                </span>
                <div>
                    <span class="font-heading font-bold text-sm text-white tracking-tight block leading-tight">Teknisi<span class="text-brand-400">Mikrotik</span></span>
                    <span class="text-[10px] text-slate-400 font-mono tracking-wider uppercase block">Portal Admin</span>
                </div>
            </a>
            <button type="button" id="admin-sidebar-close" class="lg:hidden text-slate-400 hover:text-white p-1">
                <x-icon name="close" class="h-5 w-5" />
            </button>
        </div>

        {{-- Sidebar Navigation Menu --}}
        <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto text-xs font-medium" aria-label="Navigasi Admin">
            <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-3 mb-2 font-mono">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                <x-icon name="layers" class="h-4 w-4 shrink-0" />
                <span>Dashboard Ringkasan</span>
            </a>

            <a href="{{ route('admin.consultations.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.consultations.*') ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                <span class="flex items-center gap-3">
                    <x-icon name="chat" class="h-4 w-4 shrink-0" />
                    <span>Tiket Konsultasi</span>
                </span>
                @php
                    $pendingCount = \App\Models\Consultation::where('status', 'baru')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="bg-amber-400 text-navy-950 font-bold px-2 py-0.5 rounded-full text-[10px]">{{ $pendingCount }}</span>
                @endif
            </a>

            <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-3 mt-6 mb-2 font-mono">Konten Website</div>

            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                <x-icon name="cpu" class="h-4 w-4 shrink-0" />
                <span>Layanan Setting</span>
            </a>

            <a href="{{ route('admin.pricing.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.pricing.*') ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                <x-icon name="gauge" class="h-4 w-4 shrink-0" />
                <span>Paket &amp; Harga</span>
            </a>

            <a href="{{ route('admin.portfolios.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.portfolios.*') ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                <x-icon name="network" class="h-4 w-4 shrink-0" />
                <span>Portofolio Kasus</span>
            </a>

            <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.articles.*') ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                <x-icon name="router" class="h-4 w-4 shrink-0" />
                <span>Artikel &amp; Blog</span>
            </a>

            <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.faqs.*') ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                <x-icon name="shield" class="h-4 w-4 shrink-0" />
                <span>Tanya Jawab (FAQ)</span>
            </a>

            <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider px-3 mt-6 mb-2 font-mono">Pengaturan</div>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                <x-icon name="process" class="h-4 w-4 shrink-0" />
                <span>Pengaturan Web</span>
            </a>
        </nav>

        {{-- User Profile Footer --}}
        <div class="p-4 border-t border-navy-800 bg-navy-950/70">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-lg bg-navy-800 border border-navy-700 flex items-center justify-center text-white font-bold text-xs shrink-0 font-mono">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-semibold text-white truncate leading-tight">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-slate-400 truncate mt-0.5">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                    @csrf
                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-400 rounded-lg hover:bg-navy-800 transition" title="Logout" aria-label="Keluar">
                        <x-icon name="arrow-right" class="h-4 w-4" />
                    </button>
                </form>
            </div>
            <div class="mt-3 pt-2.5 border-t border-navy-800/80">
                <a href="{{ route('home') }}" target="_blank" class="text-xs text-blue-400 hover:text-blue-300 flex items-center justify-center gap-1.5 transition-colors font-medium">
                    <span>Buka Website Publik</span>
                    <x-icon name="arrow-right" class="h-3 w-3" />
                </a>
            </div>
        </div>
    </aside>

    {{-- Main Content Shell --}}
    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen min-w-0">
        
        {{-- Top Admin Header --}}
        <header class="h-16 bg-white border-b border-slate-200/90 sticky top-0 z-30 px-6 sm:px-8 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                <button id="admin-mobile-toggle" type="button" class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition" aria-label="Buka menu navigasi">
                    <x-icon name="menu" class="h-5 w-5" />
                </button>
                <div class="min-w-0">
                    <h1 class="text-base sm:text-lg font-heading font-bold text-navy-900 leading-tight truncate">
                        @yield('page_title', 'Dashboard')
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3 text-xs shrink-0">
                <span class="text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2.5 py-1 rounded-full font-mono font-medium hidden sm:inline-flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> MySQL Database
                </span>
                <a href="{{ route('consultation.create') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium transition shadow-2xs">
                    <span>Preview Form</span>
                    <x-icon name="arrow-right" class="h-3 w-3 text-slate-400" />
                </a>
            </div>
        </header>

        {{-- Main Content Body --}}
        <main class="p-6 sm:p-8 lg:p-10 flex-1">
            <div class="max-w-7xl mx-auto space-y-6">
                {{-- Flash Notifications --}}
                @if(session('success'))
                    <div role="status" class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-3">
                        <x-icon name="check" class="h-5 w-5 text-emerald-600 shrink-0" />
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div role="alert" class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm flex items-center gap-3">
                        <x-icon name="close" class="h-5 w-5 text-red-600 shrink-0" />
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div role="alert" class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm space-y-1">
                        <p class="font-bold">Terdapat kesalahan input:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    {{-- Mobile Sidebar JS Toggle --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('admin-mobile-toggle');
            const closeBtn = document.getElementById('admin-sidebar-close');
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('admin-sidebar-backdrop');

            function openSidebar() {
                if (!sidebar || !backdrop) return;
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            }

            function closeSidebar() {
                if (!sidebar || !backdrop) return;
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }

            if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (backdrop) backdrop.addEventListener('click', closeSidebar);
        });
    </script>
    @stack('scripts')
</body>
</html>
