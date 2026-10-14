@extends('layouts.app')

@section('title', 'Portofolio Pengerjaan Jasa Setting MikroTik - Studi Kasus Nyata')
@section('meta_description', 'Dokumentasi hasil pengerjaan konfigurasi router MikroTik RouterOS untuk perkantoran, perhotelan, klinik kesehatan, dan kafe di Indonesia.')

@section('content')
{{-- 1. Hero Section --}}
<section class="border-b border-slate-200/80 bg-white py-14 sm:py-18">
    <div class="wrap">
        <div class="max-w-3xl text-left">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                Hasil Nyata Lapangan
            </span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Portofolio &amp; Studi Kasus Jaringan
            </h1>
            <p class="mt-3 text-base sm:text-lg leading-relaxed text-slate-600">
                Dokumentasi penyelesaian kendala koneksi internet riil yang telah kami tangani dari berbagai sektor operasional bisnis di Indonesia.
            </p>

            {{-- Category Filter Pills --}}
            @if(!empty($categories) && count($categories) > 0)
                <div class="mt-6 flex flex-wrap gap-2">
                    <a href="{{ route('portfolios.index') }}" class="px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition {{ empty($category) || $category == 'Semua' ? 'bg-navy-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('portfolios.index', ['category' => $cat]) }}" class="px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition {{ $category == $cat ? 'bg-navy-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

{{-- 2. Portfolio Grid --}}
<section class="section bg-surface" aria-labelledby="portfolio-list-title">
    <div class="wrap">
        @if($portfolios->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($portfolios as $p)
                    <article class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-white overflow-hidden shadow-2xs transition-all hover:border-blue-500 hover:shadow-xs">
                        {{-- Portfolio Image Asset --}}
                        @if($p->image_url)
                            <div class="w-full aspect-[4/3] bg-white border-b border-slate-100 p-2 sm:p-3 flex items-center justify-center">
                                <img src="{{ $p->image_url }}" alt="{{ $p->title }}" class="h-full w-full object-contain" loading="lazy">
                            </div>
                        @else
                            <div class="w-full aspect-[4/3] bg-slate-50 border-b border-slate-100 p-4 flex items-center justify-center text-slate-300">
                                <x-icon name="router" class="h-12 w-12" />
                            </div>
                        @endif

                        <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between space-y-4">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 font-bold border border-blue-200/60">{{ $p->category }}</span>
                                    @if($p->location)
                                        <span class="text-slate-500 flex items-center gap-1 font-medium">
                                            <x-icon name="pin" class="h-3.5 w-3.5 text-slate-400" />
                                            <span>{{ $p->location }}</span>
                                        </span>
                                    @endif
                                </div>

                                <h2 class="text-lg sm:text-xl font-bold font-heading text-navy-900 hover:text-blue-600 transition-colors leading-snug">
                                    <a href="{{ route('portfolios.show', $p->slug) }}">{{ $p->title }}</a>
                                </h2>

                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-3">
                                    {{ $p->summary }}
                                </p>
                            </div>

                            @if($p->device_used)
                                <div class="pt-2">
                                    <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-200/80 text-xs text-slate-700 flex items-center gap-2">
                                        <x-icon name="router" class="h-4 w-4 text-slate-400 shrink-0" />
                                        <span class="truncate font-mono">Router: {{ $p->device_used }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="px-6 sm:px-7 py-3.5 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between text-xs sm:text-sm">
                            <span class="text-slate-600 font-medium truncate max-w-[150px]">{{ $p->client_name }}</span>
                            <a href="{{ route('portfolios.show', $p->slug) }}" class="inline-flex items-center gap-1 font-semibold text-blue-700 hover:text-navy-900 transition-colors shrink-0">
                                <span>Detail Studi Kasus</span>
                                <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $portfolios->links() }}
            </div>
        @else
            {{-- Professional Empty State --}}
            <div class="max-w-2xl mx-auto text-center py-16 bg-white rounded-2xl border border-slate-200/90 p-8 shadow-2xs">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-4">
                    <x-icon name="topology" class="h-7 w-7" />
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-navy-900 font-heading">Dokumentasi Proyek Sedang Diperbarui</h3>
                <p class="text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">
                    Studi kasus untuk kategori ini sedang dalam tahap perapihan dokumentasi teknis. Anda tetap dapat mengonsultasikan kendala jaringan Anda bersama kami.
                </p>
                <div class="mt-6">
                    <a href="{{ route('consultation.create') }}" class="btn btn-primary">
                        Konsultasikan Kebutuhan Jaringan Anda
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- 3. CTA Konsultasi --}}
<section class="section-compact bg-navy-900 text-white">
    <div class="wrap text-center">
        <h2 class="text-2xl sm:text-3xl font-extrabold sm:text-4xl">Punya Masalah Jaringan yang Serupa?</h2>
        <p class="mx-auto mt-3 max-w-2xl text-sm sm:text-base text-slate-300 leading-relaxed">
            Diskusikan kebutuhan arsitektur jaringan tempat usaha Anda bersama tim kami secara langsung.
        </p>
        <div class="mt-7 flex justify-center">
            <a href="{{ $waLink('Halo, saya melihat portofolio Anda dan ingin konsultasi kasus jaringan saya.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-lg">
                <x-icon name="whatsapp" class="h-5 w-5" />
                <span>Konsultasi Kasus via WhatsApp</span>
            </a>
        </div>
    </div>
</section>
@endsection
