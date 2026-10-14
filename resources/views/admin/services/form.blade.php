@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Layanan' : 'Tambah Layanan Baru')
@section('page_title', $isEdit ? 'Edit Layanan Setting' : 'Tambah Layanan Baru')

@section('content')
<div class="space-y-6">
    {{-- Header Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-200/80 pb-4">
        <div>
            <h2 class="text-xl font-bold font-heading text-navy-900">
                {{ $isEdit ? 'Edit Layanan: ' . $service->title : 'Tambah Spesialisasi Layanan Baru' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Kelola informasi publik, cakupan pengerjaan, dan parameter tarif layanan.</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-slate-600 hover:text-navy-900 transition-colors">
            <x-icon name="arrow-left" class="h-4 w-4" />
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.services.update', $service->id) : route('admin.services.store') }}" method="POST">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
            {{-- Kolom Kiri: Konten & Deskripsi Utama (8 Kolom) --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Panel Konten Utama --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs space-y-6">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-navy-900 uppercase tracking-wider">Informasi Layanan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Judul dan penjelasan manfaat yang ditampilkan kepada calon pelanggan.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="title" class="label">Judul Layanan <span class="text-rose-500">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required placeholder="Contoh: Multi-ISP Load Balancing & Failover" class="field" @error('title') aria-invalid="true" @enderror>
                            @error('title')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="slug" class="label">Slug URL</label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $service->slug) }}" placeholder="multi-isp-load-balancing-failover" class="field font-mono text-xs sm:text-sm" @error('slug') aria-invalid="true" @enderror>
                            <span class="text-[11px] text-slate-400 mt-1 block">Biarkan kosong untuk membuat slug otomatis dari judul layanan.</span>
                            @error('slug')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="short_description" class="label">Ringkasan Manfaat (Tampil di Kartu Layanan) <span class="text-rose-500">*</span></label>
                            <textarea id="short_description" name="short_description" rows="2" required placeholder="Contoh: Menggabungkan 2-3 jalur internet untuk melipatgandakan bandwidth dan otomatis failover saat salah satu ISP putus." class="field leading-relaxed" @error('short_description') aria-invalid="true" @enderror>{{ old('short_description', $service->short_description) }}</textarea>
                            <span class="text-[11px] text-slate-400 mt-1 block">Teks 1-2 kalimat padat yang langsung menjelaskan solusi kepada klien.</span>
                            @error('short_description')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="full_description" class="label">Penjelasan Teknis &amp; Ruang Lingkup (Tampil di Halaman Detail)</label>
                            <textarea id="full_description" name="full_description" rows="5" placeholder="Jelaskan mekanisme kerja teknis, arsitektur topologi, dan metode penanganan secara lengkap..." class="field leading-relaxed" @error('full_description') aria-invalid="true" @enderror>{{ old('full_description', $service->full_description) }}</textarea>
                            @error('full_description')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Panel Checklist Fitur / Parameter --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs space-y-4">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-navy-900 uppercase tracking-wider">Cakupan Pekerjaan / Parameter Setting</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Daftar fitur centang yang didapatkan pelanggan saat memesan layanan ini.</p>
                    </div>

                    <div>
                        <label for="features" class="label">Daftar Poin Fitur (Ketik 1 baris per poin)</label>
                        @php
                            $featuresText = is_array($service->features) ? implode("\n", $service->features) : '';
                        @endphp
                        <textarea id="features" name="features" rows="5" placeholder="Metode PCC Load Balancing akurat 2-3 ISP&#10;Recursive Failover otomatis &lt; 2 detik&#10;Pisah jalur traffic Browsing, Streaming, dan Zoom/ERP&#10;Garansi pengerjaan &amp; monitoring 14 hari" class="field font-mono text-xs sm:text-sm leading-relaxed" @error('features') aria-invalid="true" @enderror>{{ old('features', $featuresText) }}</textarea>
                        <span class="text-xs text-slate-500 mt-1.5 block">Tekan <strong>Enter</strong> untuk membuat poin centang baru. Tiga baris pertama akan ditampilkan di kartu Beranda/Katalog.</span>
                        @error('features')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Atribut, Tarif & Publikasi (4 Kolom) --}}
            <div class="lg:col-span-4 space-y-6">
                {{-- Card 1: Tarif & Tampilan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-5">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3 font-mono">
                        Tarif &amp; Label
                    </h3>

                    <div>
                        <label for="price_start" class="label">Harga Jasa Mulai</label>
                        <input type="text" id="price_start" name="price_start"
                               value="{{ old('price_start', $service->price_start) }}"
                               placeholder="Contoh: Rp 450.000" class="field font-mono"
                               data-service-price="true" @error('price_start') aria-invalid="true" @enderror>
                        <span class="text-[11px] text-slate-500 mt-1 block">Ketik angka saja, otomatis berformat <strong>Rp XX.XXX</strong>.</span>
                        @error('price_start')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="badge" class="label">Badge Highlight (Opsional)</label>
                        <input type="text" id="badge" name="badge" value="{{ old('badge', $service->badge) }}" placeholder="Contoh: Paling Populer" class="field" @error('badge') aria-invalid="true" @enderror>
                        <span class="text-[11px] text-slate-400 mt-1 block">Label kecil pemanis di atas judul layanan.</span>
                        @error('badge')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="icon" class="label">Ikon Visual Layanan</label>
                        <select id="icon" name="icon" class="field" @error('icon') aria-invalid="true" @enderror>
                            <option value="network" {{ old('icon', $service->icon ?? 'network') === 'network' ? 'selected' : '' }}>Multi-ISP &amp; Load Balancing (Network)</option>
                            <option value="gauge" {{ old('icon', $service->icon) === 'gauge' ? 'selected' : '' }}>Bandwidth &amp; QoS (Gauge Speed)</option>
                            <option value="wifi" {{ old('icon', $service->icon) === 'wifi' ? 'selected' : '' }}>Hotspot &amp; Voucher (WiFi)</option>
                            <option value="shield" {{ old('icon', $service->icon) === 'shield' ? 'selected' : '' }}>VPN &amp; Firewall Hardening (Shield)</option>
                            <option value="layers" {{ old('icon', $service->icon) === 'layers' ? 'selected' : '' }}>VLAN &amp; Segmentasi Jaringan (Layers)</option>
                            <option value="cpu" {{ old('icon', $service->icon) === 'cpu' ? 'selected' : '' }}>Hardware &amp; Maintenance (CPU Router)</option>
                            <option value="topology" {{ old('icon', $service->icon) === 'topology' ? 'selected' : '' }}>Standar Arsitektur Jaringan (Topology)</option>
                        </select>
                        @error('icon')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Card 2: Visibilitas & Pengurutan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-4">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3 font-mono">
                        Visibilitas &amp; Urutan
                    </h3>

                    <div>
                        <label for="sort_order" class="label">Nomor Urutan Tampil</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0" class="field font-mono" @error('sort_order') aria-invalid="true" @enderror>
                        <span class="text-[11px] text-slate-400 mt-1 block">Angka lebih kecil tampil lebih dulu (0, 1, 2, ...).</span>
                        @error('sort_order')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-2 space-y-3 border-t border-slate-100">
                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-4 w-4">
                            <span class="text-xs sm:text-sm font-semibold text-slate-800">Layanan Aktif (Tampil Publik)</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $service->is_featured ?? false) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-4 w-4">
                            <span class="text-xs sm:text-sm font-semibold text-slate-800">Highlight di Halaman Beranda</span>
                        </label>
                    </div>
                </div>

                {{-- Card 3: Tombol Aksi Simpan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-2xs space-y-3">
                    <button type="submit" class="btn btn-primary btn-block text-sm min-h-[2.875rem]">
                        {{ $isEdit ? 'Simpan Perubahan Layanan' : 'Terbitkan Layanan Baru' }}
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline btn-block text-xs sm:text-sm">
                        Batal &amp; Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
