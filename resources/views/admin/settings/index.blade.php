@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('page_title', 'Konfigurasi & Informasi Website')

@section('content')
<div class="w-full bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 lg:p-10 shadow-2xs space-y-8">
    <div class="border-b border-slate-100 pb-5">
        <h2 class="text-xl font-bold font-heading text-navy-900">
            Pengaturan Informasi &amp; Kontak Website
        </h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Perubahan data di bawah ini langsung memengaruhi tampilan navbar, footer, dan tombol WhatsApp di seluruh website.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
        @csrf

        {{-- Seksi 1: Identitas & Kontak Utama --}}
        <div class="space-y-5">
            <h3 class="text-xs font-bold uppercase tracking-wider text-blue-700 font-mono">1. Identitas &amp; Kontak Utama</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                <div>
                    <label for="site_name" class="label">Nama Website / Brand</label>
                    <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'TEKNISI MIKROTIK INDONESIA') }}" class="field" placeholder="TEKNISI MIKROTIK">
                </div>
                <div>
                    <label for="email" class="label">Email Resmi Dukungan Teknis</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $settings['email'] ?? 'support@teknisimikrotik.id') }}" class="field" placeholder="support@teknisimikrotik.id">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                <div>
                    <label for="whatsapp_number" class="label">Nomor WhatsApp API (Format: 628xxxx)</label>
                    <input type="text" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '6281234567890') }}" class="field font-mono" placeholder="6281234567890">
                    <span class="text-xs text-slate-500 mt-1 block">Digunakan oleh seluruh tombol chat WhatsApp langsung.</span>
                </div>
                <div>
                    <label for="whatsapp_display" class="label">Format Tampilan Nomor WhatsApp</label>
                    <input type="text" id="whatsapp_display" name="whatsapp_display" value="{{ old('whatsapp_display', $settings['whatsapp_display'] ?? '0812-3456-7890') }}" class="field" placeholder="0812-3456-7890">
                    <span class="text-xs text-slate-500 mt-1 block">Teks nomor yang dibaca oleh pengunjung pada footer.</span>
                </div>
            </div>
        </div>

        {{-- Seksi 2: Alamat & Jam Layanan --}}
        <div class="space-y-5 pt-6 border-t border-slate-100">
            <h3 class="text-xs font-bold uppercase tracking-wider text-blue-700 font-mono">2. Alamat &amp; Jam Layanan</h3>

            <div>
                <label for="address" class="label">Alamat / Wilayah Jangkauan Layanan</label>
                <input type="text" id="address" name="address" value="{{ old('address', $settings['address'] ?? 'Jl. Jaringan Cepat No. 88, Jakarta Selatan & Melayani Remote Seluruh Indonesia') }}" class="field">
            </div>

            <div>
                <label for="operational_hours" class="label">Jam Operasional Pelayanan</label>
                <input type="text" id="operational_hours" name="operational_hours" value="{{ old('operational_hours', $settings['operational_hours'] ?? 'Senin - Sabtu: 08.00 - 22.00 WIB (Layanan Darurat 24/7)') }}" class="field">
            </div>
        </div>

        {{-- Seksi 3: Headline Banner Depan --}}
        <div class="space-y-5 pt-6 border-t border-slate-100">
            <h3 class="text-xs font-bold uppercase tracking-wider text-blue-700 font-mono">3. Headline Banner Depan (Hero)</h3>

            <div>
                <label for="hero_title" class="label">Judul Utama Banner Depan</label>
                <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" class="field" placeholder="Jaringan Lambat &amp; Sering Putus?">
            </div>

            <div>
                <label for="hero_subtitle" class="label">Sub-judul Banner Depan</label>
                <textarea id="hero_subtitle" name="hero_subtitle" rows="3" class="field leading-relaxed" placeholder="Solusi konfigurasi jaringan yang disesuaikan dengan kebutuhan bisnis Anda...">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
            </div>
        </div>

        {{-- Action Bar --}}
        <div class="pt-6 border-t border-slate-200 flex items-center justify-end">
            <button type="submit" class="btn btn-primary text-xs sm:text-sm px-6 py-2.5 shadow-xs">
                Simpan Seluruh Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
