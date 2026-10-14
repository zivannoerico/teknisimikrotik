@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Artikel' : 'Tulis Artikel')
@section('page_title', $isEdit ? 'Edit Artikel Blog' : 'Tulis Artikel Baru')

@section('content')
<div class="space-y-6">
    {{-- Header Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-200/80 pb-4">
        <div>
            <h2 class="text-xl font-bold font-heading text-navy-900">
                {{ $isEdit ? 'Edit Artikel: ' . $article->title : 'Tulis Artikel & Panduan Edukasi Baru' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Tuliskan panduan konfigurasi, tips optimasi RouterOS, atau wawasan keamanan jaringan.</p>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-slate-600 hover:text-navy-900 transition-colors">
            <x-icon name="arrow-left" class="h-4 w-4" />
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.articles.update', $article->id) : route('admin.articles.store') }}" method="POST">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
            {{-- Kolom Kiri: Naskah & Konten Utama (8 Kolom) --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Panel Informasi Artikel --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs space-y-5">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-navy-900 uppercase tracking-wider">Judul &amp; Ringkasan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Judul utama dan ringkasan yang menarik minat calon pembaca.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="title" class="label">Judul Artikel <span class="text-rose-500">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" required placeholder="Contoh: Cara Memilih Metode Load Balancing MikroTik: PCC vs ECMP" class="field" @error('title') aria-invalid="true" @enderror>
                            @error('title')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="slug" class="label">Slug URL</label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug) }}" placeholder="cara-memilih-metode-load-balancing-mikrotik" class="field font-mono text-xs sm:text-sm" @error('slug') aria-invalid="true" @enderror>
                            <span class="text-[11px] text-slate-400 mt-1 block">Biarkan kosong untuk membuat slug otomatis dari judul artikel.</span>
                            @error('slug')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="excerpt" class="label">Cuplikan Singkat / Excerpt <span class="text-rose-500">*</span></label>
                            <textarea id="excerpt" name="excerpt" rows="3" required placeholder="Tuliskan 1-2 kalimat ringkasan yang padat untuk ditampilkan pada kartu blog..." class="field leading-relaxed" @error('excerpt') aria-invalid="true" @enderror>{{ old('excerpt', $article->excerpt) }}</textarea>
                            @error('excerpt')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Panel Editor Konten Lengkap --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs space-y-4">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-navy-900 uppercase tracking-wider">Naskah Lengkap Artikel</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Tuliskan konten artikel secara detail, jelas, dan terstruktur.</p>
                    </div>

                    <div>
                        <textarea id="content" name="content" rows="16" required placeholder="Tuliskan isi artikel Anda di sini secara lengkap..." class="field font-sans leading-relaxed text-sm sm:text-base p-4" @error('content') aria-invalid="true" @enderror>{{ old('content', $article->content) }}</textarea>
                        @error('content')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Metadata, Publikasi & Aksi (4 Kolom) --}}
            <div class="lg:col-span-4 space-y-6">
                {{-- Card 1: Metadata Artikel --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-4">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3 font-mono">
                        Metadata Artikel
                    </h3>

                    <div>
                        <label for="category" class="label">Kategori Artikel <span class="text-rose-500">*</span></label>
                        <input type="text" id="category" name="category" value="{{ old('category', $article->category ?? 'Tutorial Jaringan') }}" required placeholder="Tutorial Jaringan, Keamanan Siber, dsb" class="field" @error('category') aria-invalid="true" @enderror>
                        @error('category')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="author_name" class="label">Nama Penulis <span class="text-rose-500">*</span></label>
                        <input type="text" id="author_name" name="author_name" value="{{ old('author_name', $article->author_name ?? 'Tim Teknisi MikroTik') }}" required class="field" @error('author_name') aria-invalid="true" @enderror>
                        @error('author_name')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="read_time" class="label">Estimasi Waktu Baca (Menit)</label>
                        <input type="number" id="read_time" name="read_time" value="{{ old('read_time', $article->read_time ?? 5) }}" min="1" required class="field font-mono" @error('read_time') aria-invalid="true" @enderror>
                        @error('read_time')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Card 2: Status Publikasi --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-3">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3 font-mono">
                        Status Publikasi
                    </h3>

                    <label class="flex items-center gap-3 cursor-pointer select-none pt-1">
                        <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $article->is_published ?? true) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-4 w-4">
                        <span class="text-xs sm:text-sm font-semibold text-slate-800">Publikasikan Artikel Sekarang</span>
                    </label>
                </div>

                {{-- Card 3: Tombol Aksi Simpan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-2xs space-y-3">
                    <button type="submit" class="btn btn-primary btn-block text-sm min-h-[2.875rem]">
                        {{ $isEdit ? 'Simpan Perubahan Artikel' : 'Terbitkan Artikel Sekarang' }}
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline btn-block text-xs sm:text-sm">
                        Batal &amp; Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
