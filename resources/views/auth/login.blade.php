<!DOCTYPE html>
<html lang="id" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Panel | TEKNISI MIKROTIK</title>
    <meta name="theme-color" content="#0b1f3a">
    <meta name="robots" content="noindex, nofollow">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex flex-col bg-white text-slate-800 antialiased">
    <div class="flex-1 grid grid-cols-1 md:grid-cols-12 min-h-screen">
        {{-- Panel Kiri: Brand & Informasi (Solid Dark Navy) --}}
        <div class="hidden md:flex md:col-span-5 lg:col-span-5 bg-navy-900 text-white p-8 lg:p-14 flex-col justify-between border-r border-navy-800">
            <div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group focus:outline-none" aria-label="Beranda">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 text-white transition-transform group-hover:scale-105">
                        <x-icon name="topology" class="h-6 w-6" />
                    </span>
                    <span class="font-heading text-2xl font-bold tracking-tight text-white">
                        Teknisi<span class="text-brand-400">Mikrotik</span>
                    </span>
                </a>

                <div class="mt-16 lg:mt-24 space-y-4 max-w-sm">
                    <span class="inline-flex items-center gap-2 rounded-full border border-blue-400/25 bg-blue-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-blue-300">
                        Portal Administrator
                    </span>
                    <h1 class="text-2xl lg:text-3xl font-extrabold font-heading text-white tracking-tight leading-snug">
                        Admin TEKNISIMIKROTIK
                    </h1>
                    <p class="text-slate-300 text-sm lg:text-base leading-relaxed">
                        Kelola layanan dan permintaan konsultasi jaringan Anda.
                    </p>
                </div>

                {{-- Status Layanan Minimalis --}}
                <div class="mt-8 pt-8 border-t border-white/10">
                    <div class="flex items-center gap-2.5 text-xs text-slate-400 font-mono">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Sistem Operasional &amp; Terproteksi</span>
                    </div>
                </div>
            </div>

            <div class="pt-8 text-xs text-slate-400 flex items-center justify-between">
                <span>&copy; {{ date('Y') }} TeknisiMikrotik</span>
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Website Utama &rarr;</a>
            </div>
        </div>

        {{-- Panel Kanan: Form Login (Putih, Bersih, Terpusat) --}}
        <div class="col-span-1 md:col-span-7 lg:col-span-7 bg-white flex items-center justify-center p-6 sm:p-10 lg:p-16">
            <div class="w-full max-w-[400px] space-y-8">
                {{-- Mobile Brand Header --}}
                <div class="md:hidden">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-navy-900 text-white">
                            <x-icon name="topology" class="h-5 w-5" />
                        </span>
                        <span class="font-heading text-xl font-bold tracking-tight text-navy-900">
                            Teknisi<span class="text-brand-600">Mikrotik</span>
                        </span>
                    </a>
                </div>

                {{-- Form Header --}}
                <div class="space-y-1.5">
                    <h2 class="text-2xl sm:text-3xl font-bold font-heading text-navy-900 tracking-tight">
                        Selamat Datang Kembali
                    </h2>
                    <p class="text-sm text-slate-500">
                        Masuk ke akun administrator Anda.
                    </p>
                </div>

                {{-- Session Notification / Error Alerts --}}
                @if(session('info'))
                    <div role="status" class="p-3.5 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-xs sm:text-sm">
                        {{ session('info') }}
                    </div>
                @endif

                @if($errors->any())
                    <div role="alert" class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm space-y-1">
                        @foreach($errors->all() as $err)
                            <p>{{ $err }}</p>
                        @endforeach
                    </div>
                @endif

                {{-- Form Login --}}
                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="label">Email Administrator</label>
                        <input type="email" id="email" name="email" value="{{ old('email', 'admin@teknisimikrotik.id') }}" required autocomplete="email" autofocus class="field" placeholder="admin@teknisimikrotik.id" @error('email') aria-invalid="true" @enderror>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="label mb-0">Kata Sandi</label>
                        </div>
                        <input type="password" id="password" name="password" required autocomplete="current-password" class="field" placeholder="••••••••" @error('password') aria-invalid="true" @enderror>
                    </div>

                    <div class="flex items-center justify-between text-xs sm:text-sm pt-1">
                        <label class="flex items-center gap-2 cursor-pointer text-slate-600 hover:text-slate-900 select-none">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>Ingat sesi masuk</span>
                        </label>
                    </div>

                    <div class="pt-1">
                        <button type="submit" class="btn btn-primary btn-block text-sm min-h-[2.75rem]">
                            Masuk ke Dashboard
                        </button>
                    </div>
                </form>

                {{-- Default Credentials Hint --}}
                <div class="pt-6 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-mono">
                    <span>Akses Default:</span>
                    <span class="text-slate-700 font-semibold select-all">admin@teknisimikrotik.id / password123</span>
                </div>

                <div class="pt-1 text-center md:hidden">
                    <a href="{{ route('home') }}" class="text-xs font-semibold text-slate-500 hover:text-navy-900 transition">
                        &larr; Kembali ke Website Utama
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
