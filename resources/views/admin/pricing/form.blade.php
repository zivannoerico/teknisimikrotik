@extends('layouts.admin')

@section('title', $isEdit ? 'Edit Paket Harga' : 'Tambah Paket Harga')
@section('page_title', $isEdit ? 'Edit Paket Harga' : 'Tambah Paket Harga')

@section('content')
<div class="space-y-6">
    {{-- Header Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-200/80 pb-4">
        <div>
            <h2 class="text-xl font-bold font-heading text-navy-900">
                {{ $isEdit ? 'Edit Paket: ' . $plan->name : 'Tambah Paket Harga Baru' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Atur nama paket, nominal biaya, dan daftar fitur yang disertakan.</p>
        </div>
        <a href="{{ route('admin.pricing.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-slate-600 hover:text-navy-900 transition-colors">
            <x-icon name="arrow-left" class="h-4 w-4" />
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.pricing.update', $plan->id) : route('admin.pricing.store') }}" method="POST">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
            {{-- Kolom Kiri: Informasi Paket & Fitur (8 Kolom) --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Panel Informasi Utama --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs space-y-5">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-navy-900 uppercase tracking-wider">Identitas Paket</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Nama dan penjelasan target pengguna untuk paket konfigurasi ini.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="name" class="label">Nama Paket <span class="text-rose-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $plan->name) }}" required placeholder="Contoh: Paket Bisnis &amp; Multi-ISP" class="field" @error('name') aria-invalid="true" @enderror>
                            @error('name')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="description" class="label">Deskripsi Target Pengguna</label>
                            <textarea id="description" name="description" rows="3" placeholder="Jelaskan jenis usaha yang cocok dengan paket ini (misal: Cocok untuk kantor operasional, klinik, cafe)..." class="field leading-relaxed" @error('description') aria-invalid="true" @enderror>{{ old('description', $plan->description) }}</textarea>
                            @error('description')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Panel Fitur Termasuk --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs space-y-4">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-navy-900 uppercase tracking-wider">Cakupan Layanan / Fitur Paket</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Daftar fitur checklist yang didapatkan pelanggan saat memilih paket ini.</p>
                    </div>

                    <div>
                        <label for="features" class="label">Daftar Fitur Termasuk (Ketik 1 baris per poin)</label>
                        @php
                            $featuresText = is_array($plan->features) ? implode("\n", $plan->features) : '';
                        @endphp
                        <textarea id="features" name="features" rows="6" placeholder="Setting 2-3 ISP Load Balancing (Metode PCC)&#10;Failover otomatis saat koneksi salah satu ISP drop&#10;Prioritas bandwidth Zoom, ERP, dan browsing&#10;Garansi pengerjaan &amp; monitoring 14 hari" class="field font-mono text-xs sm:text-sm leading-relaxed" @error('features') aria-invalid="true" @enderror>{{ old('features', $featuresText) }}</textarea>
                        <span class="text-xs text-slate-500 mt-1.5 block">Tekan <strong>Enter</strong> untuk membuat poin fitur baru. Tampil otomatis dengan tanda centang pada kartu paket.</span>
                        @error('features')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Biaya, Visibilitas & Aksi (4 Kolom) --}}
            <div class="lg:col-span-4 space-y-6">
                {{-- Card 1: Biaya & Ketentuan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-5">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3 font-mono">
                        Biaya &amp; Ketentuan
                    </h3>

                    <div>
                        <label for="price" class="label">Harga Nominal Rupiah <span class="text-rose-500">*</span></label>
                        <input type="text" id="price" name="price" inputmode="numeric"
                               value="{{ old('price', (isset($plan->price) && (float)$plan->price > 0) ? number_format((float)$plan->price, 0, ',', '.') : '') }}"
                               required placeholder="Contoh: 650.000" class="field font-mono"
                               data-currency-input="true" @error('price') aria-invalid="true" @enderror>
                        <span class="text-[11px] text-slate-500 mt-1 block">Otomatis berformat titik ribuan (misal: ketik 60000 &rarr; 60.000).</span>
                        @error('price')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="billing_period" class="label">Ketentuan Pembayaran <span class="text-rose-500">*</span></label>
                        <input type="text" id="billing_period" name="billing_period" value="{{ old('billing_period', $plan->billing_period ?? 'sekali setting') }}" required placeholder="sekali setting" class="field" @error('billing_period') aria-invalid="true" @enderror>
                        <span class="text-[11px] text-slate-400 mt-1 block">Contoh: sekali setting, per bulan, per router.</span>
                        @error('billing_period')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="badge" class="label">Badge Highlight (Opsional)</label>
                        <input type="text" id="badge" name="badge" value="{{ old('badge', $plan->badge) }}" placeholder="Contoh: Paling Populer, Ekonomis" class="field" @error('badge') aria-invalid="true" @enderror>
                        @error('badge')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Card 2: Visibilitas & Pengurutan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-4">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3 font-mono">
                        Visibilitas &amp; Urutan
                    </h3>

                    <div>
                        <label for="sort_order" class="label">Nomor Urutan</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $plan->sort_order ?? 0) }}" min="0" class="field font-mono" @error('sort_order') aria-invalid="true" @enderror>
                        @error('sort_order')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-2 space-y-3 border-t border-slate-100">
                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $plan->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-4 w-4">
                            <span class="text-xs sm:text-sm font-semibold text-slate-800">Paket Aktif Ditampilkan</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" id="is_popular" name="is_popular" value="1" {{ old('is_popular', $plan->is_popular ?? false) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-4 w-4">
                            <span class="text-xs sm:text-sm font-semibold text-slate-800">Tandai sebagai Rekomendasi Utama</span>
                        </label>
                    </div>
                </div>

                {{-- Card 3: Tombol Aksi Simpan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-2xs space-y-3">
                    <button type="submit" class="btn btn-primary btn-block text-sm min-h-[2.875rem]">
                        {{ $isEdit ? 'Simpan Perubahan Paket' : 'Terbitkan Paket Harga' }}
                    </button>
                    <a href="{{ route('admin.pricing.index') }}" class="btn btn-outline btn-block text-xs sm:text-sm">
                        Batal &amp; Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
