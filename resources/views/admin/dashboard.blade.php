@extends('layouts.admin')

@section('title', 'Dashboard Ringkasan')
@section('page_title', 'Ringkasan Sistem & Performa')

@section('content')
<div class="space-y-8">
    
    {{-- Metrics Grid (Clean White Cards) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- Konsultasi Baru --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 space-y-3 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono">Konsultasi Baru</span>
                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <x-icon name="chat" class="h-4 w-4" />
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold font-heading text-navy-900">{{ $stats['pending_consultations'] }}</span>
                <span class="text-xs text-slate-500 block mt-1">Perlu ditindaklanjuti teknisi</span>
            </div>
        </div>

        {{-- Total Order / Tiket --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 space-y-3 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono">Total Order / Tiket</span>
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <x-icon name="process" class="h-4 w-4" />
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold font-heading text-navy-900">{{ $stats['total_consultations'] }}</span>
                <span class="text-xs text-slate-500 block mt-1">Seluruh data konsultasi masuk</span>
            </div>
        </div>

        {{-- Layanan Setting --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 space-y-3 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono">Layanan Setting</span>
                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center">
                    <x-icon name="cpu" class="h-4 w-4" />
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold font-heading text-navy-900">{{ $stats['total_services'] }}</span>
                <span class="text-xs text-slate-500 block mt-1">{{ $stats['total_plans'] }} paket harga aktif</span>
            </div>
        </div>

        {{-- Portofolio & Artikel --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 space-y-3 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono">Portofolio &amp; Kasus</span>
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <x-icon name="network" class="h-4 w-4" />
                </div>
            </div>
            <div>
                <span class="text-3xl font-extrabold font-heading text-navy-900">{{ $stats['total_portfolios'] }}</span>
                <span class="text-xs text-slate-500 block mt-1">{{ $stats['total_articles'] }} artikel blog diterbitkan</span>
            </div>
        </div>

    </div>

    {{-- Recent Inquiries Table --}}
    <div class="bg-white border border-slate-200/90 rounded-2xl overflow-hidden shadow-2xs">
        <div class="p-5 sm:p-6 border-b border-slate-200/80 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-base sm:text-lg font-bold font-heading text-navy-900">Tiket Konsultasi Terbaru</h2>
                <p class="text-xs text-slate-500 mt-0.5">Daftar klien yang baru saja mengajukan permohonan setting</p>
            </div>
            <a href="{{ route('admin.consultations.index') }}" class="text-xs font-semibold text-blue-700 hover:text-navy-900 inline-flex items-center gap-1 transition-colors shrink-0">
                <span>Lihat Semua Tiket</span>
                <x-icon name="arrow-right" class="h-3.5 w-3.5" />
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50/80 text-slate-500 uppercase font-mono text-[11px] border-b border-slate-200">
                    <tr>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Nama &amp; WhatsApp</th>
                        <th class="p-4">Instansi</th>
                        <th class="p-4">Layanan</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($recentConsultations as $c)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="p-4 font-mono text-slate-500 whitespace-nowrap">{{ $c->created_at->format('d/m/Y H:i') }}</td>
                        <td class="p-4">
                            <span class="font-bold text-navy-900 block">{{ $c->name }}</span>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $c->phone) }}" target="_blank" class="text-emerald-700 hover:underline inline-flex items-center gap-1 font-mono text-[11px] mt-0.5 font-medium">
                                <x-icon name="whatsapp" class="h-3.5 w-3.5 text-emerald-600" />
                                <span>{{ $c->phone }}</span>
                            </a>
                        </td>
                        <td class="p-4 text-slate-600">{{ $c->company_or_institution ?: '-' }}</td>
                        <td class="p-4 font-medium text-navy-900">{{ $c->service_type }}</td>
                        <td class="p-4 whitespace-nowrap">
                            @if($c->status == 'baru')
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200/80 font-semibold text-[10px] uppercase">Baru</span>
                            @elseif($c->status == 'diproses')
                                <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200/80 font-semibold text-[10px] uppercase">Diproses</span>
                            @elseif($c->status == 'selesai')
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/80 font-semibold text-[10px] uppercase">Selesai</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 border border-slate-200 text-[10px] uppercase">Batal</span>
                            @endif
                        </td>
                        <td class="p-4 text-right whitespace-nowrap">
                            <a href="{{ route('admin.consultations.show', $c->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium transition shadow-2xs">
                                <span>Rincian</span>
                                <x-icon name="arrow-right" class="h-3 w-3 text-slate-400" />
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">Belum ada data konsultasi masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Action Shortcuts --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <a href="{{ route('admin.services.create') }}" class="bg-white p-5 rounded-2xl border border-slate-200/90 hover:border-blue-500 hover:shadow-xs transition flex items-center gap-4 group">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                <x-icon name="plus" class="h-5 w-5" />
            </div>
            <div>
                <span class="text-sm font-bold text-navy-900 block group-hover:text-blue-700 transition">Tambah Layanan</span>
                <span class="text-xs text-slate-500">Buat paket servis baru</span>
            </div>
        </a>

        <a href="{{ route('admin.portfolios.create') }}" class="bg-white p-5 rounded-2xl border border-slate-200/90 hover:border-blue-500 hover:shadow-xs transition flex items-center gap-4 group">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                <x-icon name="network" class="h-5 w-5" />
            </div>
            <div>
                <span class="text-sm font-bold text-navy-900 block group-hover:text-blue-700 transition">Tambah Portofolio</span>
                <span class="text-xs text-slate-500">Dokumentasikan kasus baru</span>
            </div>
        </a>

        <a href="{{ route('admin.settings.index') }}" class="bg-white p-5 rounded-2xl border border-slate-200/90 hover:border-blue-500 hover:shadow-xs transition flex items-center gap-4 group">
            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0">
                <x-icon name="process" class="h-5 w-5" />
            </div>
            <div>
                <span class="text-sm font-bold text-navy-900 block group-hover:text-blue-700 transition">Pengaturan Website</span>
                <span class="text-xs text-slate-500">Ubah kontak WhatsApp &amp; info</span>
            </div>
        </a>
    </div>

</div>
@endsection
