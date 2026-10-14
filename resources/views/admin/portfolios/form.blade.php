@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Portofolio' : 'Tambah Portofolio')
@section('page_title', $isEdit ? 'Edit Portofolio Kasus' : 'Tambah Portofolio Baru')

@section('content')
<div class="space-y-6">
    {{-- Header Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-200/80 pb-4">
        <div>
            <h2 class="text-xl font-bold font-heading text-navy-900">
                {{ $isEdit ? 'Edit Portofolio: ' . $portfolio->client_name : 'Tambah Studi Kasus Baru' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Dokumentasikan rincian klien, kendala awal, solusi RouterOS, dan hasil pengujian lapangan.</p>
        </div>
        <a href="{{ route('admin.portfolios.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-slate-600 hover:text-navy-900 transition-colors">
            <x-icon name="arrow-left" class="h-4 w-4" />
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.portfolios.update', $portfolio->id) : route('admin.portfolios.store') }}" method="POST">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
            {{-- Kolom Kiri: Informasi Kasus & Analisis Teknis (8 Kolom) --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Panel Kasus Utama --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs space-y-5">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-navy-900 uppercase tracking-wider">Identitas Proyek</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Judul studi kasus dan ringkasan penyelesaian yang dibaca pengunjung.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="title" class="label">Judul Kasus Portofolio <span class="text-rose-500">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title', $portfolio->title) }}" required placeholder="Contoh: Optimalisasi Jaringan &amp; Failover PT. Surya Logistik Makmur" class="field" @error('title') aria-invalid="true" @enderror>
                            @error('title')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="slug" class="label">Slug URL</label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $portfolio->slug) }}" placeholder="optimalisasi-failover-pt-surya-logistik" class="field font-mono text-xs sm:text-sm" @error('slug') aria-invalid="true" @enderror>
                            <span class="text-[11px] text-slate-400 mt-1 block">Biarkan kosong untuk membuat slug otomatis dari judul kasus.</span>
                            @error('slug')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="summary" class="label">Ringkasan Masalah &amp; Hasil Akhir <span class="text-rose-500">*</span></label>
                            <textarea id="summary" name="summary" rows="3" required placeholder="Jelaskan secara ringkas kendala awal klien dan hasil terukur setelah konfigurasi..." class="field leading-relaxed" @error('summary') aria-invalid="true" @enderror>{{ old('summary', $portfolio->summary) }}</textarea>
                            @error('summary')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Panel Problem, Solution & Result --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs space-y-5">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-navy-900 uppercase tracking-wider">Analisis Teknis Lapangan (Problem, Solution, Result)</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Uraian mendalam yang ditampilkan pada halaman detail studi kasus.</p>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="challenge" class="label text-rose-800 font-bold">1. Kendala &amp; Masalah Awal Klien</label>
                            <textarea id="challenge" name="challenge" rows="4" placeholder="Deskripsikan kondisi koneksi sebelum diperbaiki, misalnya: sering drop saat meeting, karyawan rebutan bandwidth, sistem ERP tidak bisa diakses..." class="field leading-relaxed text-xs sm:text-sm" @error('challenge') aria-invalid="true" @enderror>{{ old('challenge', $portfolio->challenge) }}</textarea>
                            @error('challenge')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="solution" class="label text-blue-800 font-bold">2. Solusi Setting yang Diterapkan</label>
                            <textarea id="solution" name="solution" rows="4" placeholder="Uraikan konfigurasi yang dipasang, misalnya: load balancing PCC 3 ISP, failover otomatis recursive routing, Queue Tree prioritas aplikasi..." class="field leading-relaxed text-xs sm:text-sm" @error('solution') aria-invalid="true" @enderror>{{ old('solution', $portfolio->solution) }}</textarea>
                            @error('solution')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="result" class="label text-emerald-800 font-bold">3. Hasil Pengujian Nyata</label>
                            <textarea id="result" name="result" rows="4" placeholder="Sampaikan dampak positif setelah setting, misalnya: uptime 99.98%, keluhan lemot hilang 100%, bandwidth terbagi rata dan stabil..." class="field leading-relaxed text-xs sm:text-sm" @error('result') aria-invalid="true" @enderror>{{ old('result', $portfolio->result) }}</textarea>
                            @error('result')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Profil Klien, Visibilitas & Aksi (4 Kolom) --}}
            <div class="lg:col-span-4 space-y-6">
                {{-- Card 1: Profil Klien & Perangkat --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-4">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3 font-mono">
                        Data Klien &amp; Perangkat
                    </h3>

                    <div>
                        <label for="client_name" class="label">Nama Klien / Usaha <span class="text-rose-500">*</span></label>
                        <input type="text" id="client_name" name="client_name" value="{{ old('client_name', $portfolio->client_name) }}" required placeholder="PT. Surya Logistik Makmur" class="field" @error('client_name') aria-invalid="true" @enderror>
                        @error('client_name')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="category" class="label">Kategori Sektor <span class="text-rose-500">*</span></label>
                        <input type="text" id="category" name="category" value="{{ old('category', $portfolio->category ?? 'Perkantoran') }}" required placeholder="Perkantoran, Perhotelan, Cafe, Klinik, dsb" class="field" @error('category') aria-invalid="true" @enderror>
                        @error('category')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="location" class="label">Kota / Lokasi</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $portfolio->location) }}" placeholder="Jakarta Selatan" class="field" @error('location') aria-invalid="true" @enderror>
                        @error('location')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="device_used" class="label">Model Router MikroTik</label>
                        <input type="text" id="device_used" name="device_used" value="{{ old('device_used', $portfolio->device_used) }}" placeholder="CCR2004-16G-2S+, RB4011, hEX" class="field font-mono text-xs sm:text-sm" @error('device_used') aria-invalid="true" @enderror>
                        @error('device_used')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Card 2: Visibilitas & Urutan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-4">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3 font-mono">
                        Visibilitas &amp; Urutan
                    </h3>

                    <div>
                        <label for="sort_order" class="label">Nomor Urutan Tampil</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $portfolio->sort_order ?? 0) }}" min="0" class="field font-mono" @error('sort_order') aria-invalid="true" @enderror>
                        @error('sort_order')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-2 space-y-3 border-t border-slate-100">
                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $portfolio->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-4 w-4">
                            <span class="text-xs sm:text-sm font-semibold text-slate-800">Tampilkan di Publik</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $portfolio->is_featured ?? false) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-4 w-4">
                            <span class="text-xs sm:text-sm font-semibold text-slate-800">Featured di Beranda</span>
                        </label>
                    </div>
                </div>

                {{-- Card 3: Tombol Aksi Simpan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-2xs space-y-3">
                    <button type="submit" class="btn btn-primary btn-block text-sm min-h-[2.875rem]">
                        {{ $isEdit ? 'Simpan Perubahan Portofolio' : 'Terbitkan Portofolio Baru' }}
                    </button>
                    <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline btn-block text-xs sm:text-sm">
                        Batal &amp; Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
