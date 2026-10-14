@extends('layouts.app')

@section('title', 'Permohonan Konsultasi Berhasil Diterima')

@section('content')
<div class="bg-surface py-14 sm:py-20 flex items-center justify-center">
    <div class="wrap max-w-xl text-center space-y-6">
        {{-- Success Icon --}}
        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto shadow-2xs">
            <x-icon name="check" class="h-8 w-8 text-emerald-600" />
        </div>

        <div class="space-y-2">
            <span class="text-xs font-mono font-semibold text-blue-700 uppercase tracking-wider block">
                Tiket Konsultasi #{{ str_pad($consultation->id, 5, '0', STR_PAD_LEFT) }}
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold font-heading text-navy-900 tracking-tight">
                Permohonan Anda Berhasil Terkirim
            </h1>
            <p class="text-slate-600 text-sm sm:text-base max-w-md mx-auto leading-relaxed">
                Terima kasih, <strong>{{ $consultation->name }}</strong>. Rincian keluhan jaringan Anda telah masuk ke sistem kami dan sedang ditelaah oleh tim teknis.
            </p>
        </div>

        {{-- Ticket Summary Box --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 text-left text-xs sm:text-sm space-y-3 shadow-2xs">
            <div class="flex justify-between items-center border-b border-slate-100 pb-2.5">
                <span class="text-slate-500">Layanan Dipilih:</span>
                <span class="text-navy-900 font-semibold">{{ $consultation->service_type }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-slate-100 pb-2.5">
                <span class="text-slate-500">Nomor WhatsApp:</span>
                <span class="text-navy-900 font-mono font-semibold">{{ $consultation->phone }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">Status Permohonan:</span>
                <span class="px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 font-semibold uppercase text-[11px] border border-amber-200/70">
                    Menunggu Respon Teknisi
                </span>
            </div>
        </div>

        {{-- WhatsApp Direct Redirect Action --}}
        <div class="space-y-4 pt-2">
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md mx-auto">
                Untuk penanganan langsung tanpa menunggu antrean, Anda dapat langsung menghubungkan percakapan ke WhatsApp engineer kami sekarang:
            </p>
            @php
                $waUrl = session('wa_url') ?? "https://wa.me/" . ($siteSettings['whatsapp_number'] ?? '6281234567890');
            @endphp
            <div>
                <a href="{{ $waUrl }}" target="_blank" class="btn btn-wa btn-lg w-full sm:w-auto inline-flex items-center justify-center gap-2">
                    <x-icon name="whatsapp" class="h-5 w-5" />
                    <span>Lanjutkan Chat WhatsApp Sekarang</span>
                </a>
            </div>
            <div class="pt-2">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-slate-500 hover:text-navy-900 transition">
                    <x-icon name="arrow-left" class="h-4 w-4" />
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
