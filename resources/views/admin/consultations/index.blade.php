@extends('layouts.admin')

@section('title', 'Kelola Tiket Konsultasi')
@section('page_title', 'Daftar Tiket Konsultasi & Order')

@section('content')
<div class="space-y-6">
    {{-- Header & Filter Tabs --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg sm:text-xl font-bold font-heading text-navy-900">Tiket Konsultasi Klien</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Kelola data permohonan setting dan tindak lanjut percakapan teknis WhatsApp.</p>
        </div>

        {{-- Filter Status Tabs --}}
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.consultations.index') }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold transition {{ empty($status) ? 'bg-navy-900 text-white shadow-2xs' : 'bg-white text-slate-600 border border-slate-200/90 hover:bg-slate-50' }}">
                Semua ({{ $counts['all'] }})
            </a>
            <a href="{{ route('admin.consultations.index', ['status' => 'baru']) }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold transition {{ $status == 'baru' ? 'bg-amber-500 text-navy-950 font-bold shadow-2xs' : 'bg-white text-amber-700 border border-slate-200/90 hover:bg-slate-50' }}">
                Baru ({{ $counts['baru'] }})
            </a>
            <a href="{{ route('admin.consultations.index', ['status' => 'diproses']) }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold transition {{ $status == 'diproses' ? 'bg-blue-600 text-white shadow-2xs' : 'bg-white text-blue-700 border border-slate-200/90 hover:bg-slate-50' }}">
                Diproses ({{ $counts['diproses'] }})
            </a>
            <a href="{{ route('admin.consultations.index', ['status' => 'selesai']) }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold transition {{ $status == 'selesai' ? 'bg-emerald-600 text-white shadow-2xs' : 'bg-white text-emerald-700 border border-slate-200/90 hover:bg-slate-50' }}">
                Selesai ({{ $counts['selesai'] }})
            </a>
            <a href="{{ route('admin.consultations.index', ['status' => 'dibatalkan']) }}" class="px-3 py-1.5 rounded-xl text-xs font-semibold transition {{ $status == 'dibatalkan' ? 'bg-slate-700 text-white shadow-2xs' : 'bg-white text-slate-500 border border-slate-200/90 hover:bg-slate-50' }}">
                Batal ({{ $counts['dibatalkan'] }})
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-white border border-slate-200/90 rounded-2xl overflow-hidden shadow-2xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50/80 text-slate-500 uppercase font-mono text-[11px] border-b border-slate-200">
                    <tr>
                        <th class="p-4">ID &amp; Tanggal</th>
                        <th class="p-4">Klien &amp; Kontak</th>
                        <th class="p-4">Instansi</th>
                        <th class="p-4">Layanan &amp; Device</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($consultations as $c)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="p-4 whitespace-nowrap">
                            <span class="font-mono text-blue-700 font-bold block">#{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span class="text-slate-400 text-xs font-mono mt-0.5 block">{{ $c->created_at->format('d/m/Y H:i') }}</span>
                        </td>
                        <td class="p-4">
                            <span class="font-bold text-navy-900 text-sm sm:text-base block leading-snug">{{ $c->name }}</span>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $c->phone) }}" target="_blank" class="text-emerald-700 hover:underline inline-flex items-center gap-1 mt-0.5 font-mono text-xs font-medium">
                                <x-icon name="whatsapp" class="h-3.5 w-3.5 text-emerald-600" />
                                <span>{{ $c->phone }}</span>
                            </a>
                            @if($c->email)
                                <span class="text-slate-400 text-xs block mt-0.5">{{ $c->email }}</span>
                            @endif
                        </td>
                        <td class="p-4 text-slate-600 font-medium">{{ $c->company_or_institution ?: '-' }}</td>
                        <td class="p-4 max-w-xs">
                            <span class="text-slate-900 font-semibold block leading-snug">{{ $c->service_type }}</span>
                            @if($c->mikrotik_model)
                                <span class="text-xs text-slate-500 font-mono block mt-0.5">Model: {{ $c->mikrotik_model }}</span>
                            @endif
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            @if($c->status == 'baru')
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200/80 font-semibold uppercase text-[10px]">Baru</span>
                            @elseif($c->status == 'diproses')
                                <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200/80 font-semibold uppercase text-[10px]">Diproses</span>
                            @elseif($c->status == 'selesai')
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/80 font-semibold uppercase text-[10px]">Selesai</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 border border-slate-200 text-[10px] uppercase">Batal</span>
                            @endif
                        </td>
                        <td class="p-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('admin.consultations.show', $c->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium transition shadow-2xs text-xs" title="Lihat Rincian Tiket">
                                    <span>Detail</span>
                                    <x-icon name="arrow-right" class="h-3 w-3 text-slate-400" />
                                </a>
                                <form action="{{ route('admin.consultations.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tiket konsultasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-red-50 hover:border-red-300 hover:text-red-600 text-slate-700 text-xs font-medium transition shadow-2xs" title="Hapus Tiket">
                                        <x-icon name="trash" class="h-3.5 w-3.5 text-red-500" />
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">Belum ada tiket konsultasi pada filter ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($consultations->hasPages())
        <div class="pt-2">
            {{ $consultations->links() }}
        </div>
    @endif
</div>
@endsection
