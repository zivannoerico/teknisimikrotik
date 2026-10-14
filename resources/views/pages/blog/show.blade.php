@extends('layouts.app')

@section('title', $article->title . ' - Blog Teknisi MikroTik')
@section('meta_description', $article->excerpt)

@section('content')
<div class="bg-surface py-10 sm:py-14">
    <div class="wrap max-w-4xl">
        {{-- Breadcrumb Navigation --}}
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-slate-500 mb-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-navy-900 transition-colors">Beranda</a>
            <x-icon name="chevron-right" class="h-3 w-3 text-slate-400" />
            <a href="{{ route('articles.index') }}" class="hover:text-navy-900 transition-colors">Blog</a>
            <x-icon name="chevron-right" class="h-3 w-3 text-slate-400" />
            <span class="text-navy-900 font-semibold truncate">{{ $article->title }}</span>
        </nav>

        {{-- Article Container --}}
        <article class="bg-white rounded-2xl border border-slate-200/90 p-7 sm:p-11 shadow-2xs space-y-8">
            {{-- Header --}}
            <header class="space-y-4 border-b border-slate-100 pb-8">
                <div class="flex flex-wrap items-center gap-2.5 text-xs">
                    <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 font-bold border border-blue-200/60">
                        {{ $article->category }}
                    </span>
                    @if($article->read_time)
                        <span class="text-slate-500 flex items-center gap-1 font-medium">
                            <x-icon name="clock" class="h-3.5 w-3.5 text-slate-400" />
                            <span>{{ $article->read_time }} menit baca</span>
                        </span>
                    @endif
                    <span class="text-slate-300">&middot;</span>
                    <span class="text-slate-500">
                        {{ $article->published_at ? $article->published_at->format('d M Y') : date('d M Y') }}
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-heading text-navy-900 leading-tight">
                    {{ $article->title }}
                </h1>

                <div class="flex items-center gap-3 pt-2 text-xs sm:text-sm text-slate-600">
                    <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center font-bold">
                        <x-icon name="user" class="h-4 w-4" />
                    </div>
                    <div>
                        <span class="font-bold text-navy-900 block">{{ $article->author_name }}</span>
                        <span class="text-slate-500 text-xs">Tim Teknis TEKNISIMIKROTIK</span>
                    </div>
                </div>
            </header>

            {{-- Excerpt Box --}}
            @if($article->excerpt)
                <div class="bg-slate-50 border-l-4 border-blue-600 p-4 sm:p-5 rounded-r-xl text-slate-700 text-sm sm:text-base leading-relaxed italic">
                    {{ $article->excerpt }}
                </div>
            @endif

            {{-- Main Content --}}
            <div class="text-slate-700 text-sm sm:text-base leading-relaxed space-y-5">
                <div class="whitespace-pre-line">{{ $article->content }}</div>
            </div>

            {{-- Bottom Support CTA --}}
            <div class="mt-10 pt-6 border-t border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-5 bg-slate-50 p-6 rounded-2xl border border-slate-200/80">
                <div class="space-y-1 text-center sm:text-left">
                    <h2 class="text-base sm:text-lg font-bold font-heading text-navy-900">Butuh Bantuan Setting Router Anda?</h2>
                    <p class="text-xs sm:text-sm text-slate-600">Engineer kami dapat membantu konfigurasi RouterOS secara live remote atau on-site visit.</p>
                </div>
                <a href="{{ route('consultation.create') }}" class="btn btn-primary btn-sm whitespace-nowrap shrink-0">
                    Konsultasi Sekarang
                </a>
            </div>
        </article>

        {{-- Related Articles --}}
        @if($recentArticles->count() > 0)
            <div class="mt-12 space-y-4">
                <h3 class="text-lg sm:text-xl font-bold font-heading text-navy-900">Artikel Terkait Lainnya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($recentArticles as $ra)
                        <a href="{{ route('articles.show', $ra->slug) }}" class="bg-white p-5 rounded-xl border border-slate-200/90 hover:border-slate-300 transition-colors block shadow-2xs">
                            <span class="text-xs text-blue-700 font-bold block">{{ $ra->category }}</span>
                            <h4 class="text-sm sm:text-base font-bold text-navy-900 mt-1 hover:text-blue-600 transition-colors leading-snug">{{ $ra->title }}</h4>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
