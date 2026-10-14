@extends('layouts.app')

@section('title', 'Artikel, Tutorial & Tips Setting MikroTik')
@section('meta_description', 'Kumpulan artikel edukasi jaringan komputer, tutorial konfigurasi MikroTik RouterOS, keamanan siber, dan manajemen bandwidth.')

@section('content')
{{-- 1. Hero Section --}}
<section class="border-b border-slate-200/80 bg-white py-14 sm:py-18">
    <div class="wrap">
        <div class="max-w-3xl text-left">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                Edukasi Jaringan
            </span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Artikel &amp; Panduan MikroTik
            </h1>
            <p class="mt-3 text-base sm:text-lg leading-relaxed text-slate-600">
                Wawasan praktis seputar konfigurasi RouterOS, manajemen bandwidth, dan tips keamanan jaringan komputer.
            </p>

            {{-- Search Bar --}}
            <div class="mt-6 max-w-md">
                <form action="{{ route('articles.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari topik atau tutorial..." class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 pl-10 text-sm text-slate-800 placeholder-slate-400 focus:outline-hidden focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                    <x-icon name="search" class="absolute left-3.5 top-3 text-slate-400 h-4 w-4" />
                </form>
            </div>
        </div>
    </div>
</section>

{{-- 2. Articles Grid --}}
<section class="section bg-surface" aria-labelledby="articles-list-title">
    <div class="wrap">
        @if($articles->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($articles as $art)
                    <article class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-7 shadow-2xs transition-all hover:border-blue-500 hover:shadow-xs">
                        <div class="space-y-3.5">
                            <div class="flex items-center justify-between text-xs text-slate-500">
                                <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 font-bold border border-blue-200/60">{{ $art->category }}</span>
                                @if($art->read_time)
                                    <span class="flex items-center gap-1 font-medium">
                                        <x-icon name="clock" class="h-3.5 w-3.5 text-slate-400" />
                                        <span>{{ $art->read_time }} menit</span>
                                    </span>
                                @endif
                            </div>

                            <h2 class="text-lg sm:text-xl font-bold font-heading text-navy-900 hover:text-blue-600 transition-colors leading-snug">
                                <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                            </h2>

                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-3">
                                {{ $art->excerpt }}
                            </p>
                        </div>

                        <div class="pt-5 mt-5 border-t border-slate-100 flex items-center justify-between text-xs sm:text-sm">
                            <span class="font-medium text-slate-500 truncate max-w-[140px]">{{ $art->author_name }}</span>
                            <a href="{{ route('articles.show', $art->slug) }}" class="inline-flex items-center gap-1 font-semibold text-blue-700 hover:text-navy-900 transition-colors shrink-0">
                                <span>Baca Artikel</span>
                                <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        @else
            <div class="max-w-2xl mx-auto text-center py-16 bg-white rounded-2xl border border-slate-200/90 p-8 shadow-2xs">
                <h3 class="text-xl sm:text-2xl font-bold text-navy-900 font-heading">Belum Ada Artikel yang Sesuai</h3>
                <p class="text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">
                    Tidak ditemukan artikel dengan kata kunci pencarian tersebut. Silakan coba kata kunci lain atau lihat seluruh arsip.
                </p>
                <div class="mt-6">
                    <a href="{{ route('articles.index') }}" class="btn btn-outline">Lihat Semua Artikel</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
