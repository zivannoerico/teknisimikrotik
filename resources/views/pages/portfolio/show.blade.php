@extends('layouts.app')

@section('title', $portfolio->title . ' - Studi Kasus Portofolio')
@section('meta_description', $portfolio->summary)

@section('content')
<div class="bg-surface py-10 sm:py-14">
    <div class="wrap">
        {{-- Breadcrumb Navigation --}}
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-slate-500 mb-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-navy-900 transition-colors">Beranda</a>
            <x-icon name="chevron-right" class="h-3 w-3 text-slate-400" />
            <a href="{{ route('portfolios.index') }}" class="hover:text-navy-900 transition-colors">Portofolio</a>
            <x-icon name="chevron-right" class="h-3 w-3 text-slate-400" />
            <span class="text-navy-900 font-semibold truncate">{{ $portfolio->client_name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
            {{-- Main Content: Editorial Single Container --}}
            <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200/90 p-7 sm:p-10 shadow-2xs space-y-8">
                {{-- Header --}}
                <div class="space-y-3 pb-8 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <span class="px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-200/60">
                            {{ $portfolio->category }}
                        </span>
                        @if($portfolio->location)
                            <span class="text-xs sm:text-sm text-slate-500 flex items-center gap-1 font-medium">
                                <x-icon name="pin" class="h-3.5 w-3.5 text-slate-400" />
                                <span>{{ $portfolio->location }}</span>
                            </span>
                        @endif
                    </div>

                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-heading text-navy-900 tracking-tight leading-tight">
                        {{ $portfolio->title }}
                    </h1>

                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                        {{ $portfolio->summary }}
                    </p>

                    @if($portfolio->image_url)
                        <div class="pt-4">
                            <div class="rounded-xl border border-slate-200/80 bg-white p-3 sm:p-5 flex items-center justify-center">
                                <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" class="h-auto max-h-[520px] w-full object-contain mx-auto" loading="lazy">
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Challenge, Solution, Result Breakdown --}}
                <div class="space-y-6">
                    @if($portfolio->challenge)
                        <div class="rounded-xl border border-rose-200/80 bg-rose-50/40 p-6 space-y-2">
                            <h2 class="text-base sm:text-lg font-bold text-rose-950 flex items-center gap-2">
                                <x-icon name="shield" class="h-5 w-5 text-rose-600 shrink-0" />
                                <span>Kendala &amp; Masalah Awal Klien</span>
                            </h2>
                            <p class="text-slate-700 text-sm sm:text-base leading-relaxed whitespace-pre-line">{{ $portfolio->challenge }}</p>
                        </div>
                    @endif

                    @if($portfolio->solution)
                        <div class="rounded-xl border border-blue-200/80 bg-blue-50/30 p-6 space-y-2">
                            <h2 class="text-base sm:text-lg font-bold text-navy-900 flex items-center gap-2">
                                <x-icon name="process" class="h-5 w-5 text-blue-600 shrink-0" />
                                <span>Solusi Arsitektur yang Diterapkan</span>
                            </h2>
                            <p class="text-slate-700 text-sm sm:text-base leading-relaxed whitespace-pre-line">{{ $portfolio->solution }}</p>
                        </div>
                    @endif

                    @if($portfolio->result)
                        <div class="rounded-xl border border-emerald-200/80 bg-emerald-50/30 p-6 space-y-2">
                            <h2 class="text-base sm:text-lg font-bold text-emerald-950 flex items-center gap-2">
                                <x-icon name="check" class="h-5 w-5 text-emerald-600 shrink-0" />
                                <span>Hasil Pengujian &amp; Dampak Nyata</span>
                            </h2>
                            <p class="text-slate-700 text-sm sm:text-base leading-relaxed whitespace-pre-line">{{ $portfolio->result }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Sidebar --}}
            <aside class="lg:col-span-4">
                <div class="space-y-6 lg:sticky lg:top-24">
                    <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 space-y-5 shadow-2xs">
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Rincian Proyek
                        </h3>

                    <div class="space-y-3.5 text-xs sm:text-sm">
                        <div>
                            <span class="text-slate-500 block text-xs">Nama Klien / Kasus:</span>
                            <span class="text-navy-900 font-bold text-sm sm:text-base block mt-0.5">{{ $portfolio->client_name }}</span>
                        </div>
                        <div>
                            <span class="text-slate-500 block text-xs">Sektor Industri:</span>
                            <span class="text-slate-800 font-medium block mt-0.5">{{ $portfolio->category }}</span>
                        </div>
                        <div>
                            <span class="text-slate-500 block text-xs">Model Perangkat Router:</span>
                            <span class="text-blue-700 font-mono font-semibold block mt-0.5">{{ $portfolio->device_used ?? 'MikroTik RouterOS' }}</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 space-y-3">
                        <a href="{{ route('consultation.create') }}" class="btn btn-primary btn-block text-sm">
                            Konsultasikan Kasus Serupa
                        </a>
                        <a href="{{ $waLink('Halo, saya membaca studi kasus: ' . $portfolio->title . ' dan ingin konsultasi kendala serupa.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-block text-sm">
                            <x-icon name="whatsapp" class="h-4 w-4" />
                            <span>Chat via WhatsApp</span>
                        </a>
                    </div>
                </div>

                @if($relatedPortfolios->count() > 0)
                    <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-2xs space-y-3.5">
                        <h4 class="text-xs font-bold text-navy-900 uppercase tracking-wider">Studi Kasus Terkait</h4>
                        <div class="space-y-2.5">
                            @foreach($relatedPortfolios as $rp)
                                <a href="{{ route('portfolios.show', $rp->slug) }}" class="block p-3 rounded-xl bg-slate-50 border border-slate-200/80 hover:border-slate-300 transition-colors">
                                    <span class="text-xs text-blue-700 font-semibold block">{{ $rp->category }}</span>
                                    <span class="text-xs sm:text-sm font-bold text-navy-900 line-clamp-2 mt-0.5">{{ $rp->title }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
