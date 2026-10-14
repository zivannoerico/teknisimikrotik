@extends('layouts.admin')

@section('title', 'Kelola Portofolio')
@section('page_title', 'Daftar Portofolio & Kasus Jaringan')

@section('content')
<div class="space-y-6">
    {{-- Toolbar Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg sm:text-xl font-bold font-heading text-navy-900">Studi Kasus Jaringan</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Total {{ $portfolios->count() }} dokumentasi proyek riil yang ditampilkan di website.</p>
        </div>
        <a href="{{ route('admin.portfolios.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-navy-900 px-4 py-2.5 text-xs sm:text-sm font-semibold text-white shadow-xs transition hover:bg-navy-950 shrink-0">
            <x-icon name="plus" class="h-4 w-4" />
            <span>Tambah Portofolio Baru</span>
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white border border-slate-200/90 rounded-2xl overflow-hidden shadow-2xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50/80 text-slate-500 uppercase font-mono text-[11px] border-b border-slate-200">
                    <tr>
                        <th class="p-4">Klien &amp; Lokasi</th>
                        <th class="p-4">Judul Studi Kasus</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Perangkat</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($portfolios as $p)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="p-4 whitespace-nowrap">
                            <span class="font-bold text-navy-900 text-sm sm:text-base block">{{ $p->client_name }}</span>
                            <span class="text-slate-400 text-xs flex items-center gap-1 mt-0.5">
                                <x-icon name="pin" class="h-3 w-3 text-slate-400" />
                                <span>{{ $p->location ?? 'Indonesia' }}</span>
                            </span>
                        </td>
                        <td class="p-4 max-w-sm">
                            <span class="text-slate-900 font-semibold text-xs sm:text-sm block leading-snug line-clamp-1">{{ $p->title }}</span>
                            <span class="text-slate-500 text-xs block mt-1 line-clamp-1 leading-relaxed">{{ $p->summary }}</span>
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 text-[11px] font-semibold border border-blue-200/60">{{ $p->category }}</span>
                        </td>
                        <td class="p-4 font-mono text-xs text-blue-700 whitespace-nowrap font-medium">{{ $p->device_used ?? '-' }}</td>
                        <td class="p-4 whitespace-nowrap">
                            @if($p->is_active)
                                <span class="text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Aktif</span>
                            @else
                                <span class="text-slate-500 bg-slate-100 border border-slate-200 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="p-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('admin.portfolios.edit', $p->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-blue-50 hover:border-blue-300 hover:text-blue-700 text-slate-700 text-xs font-medium transition shadow-2xs" title="Edit Portofolio">
                                    <x-icon name="pencil" class="h-3.5 w-3.5 text-blue-600" />
                                    <span>Edit</span>
                                </a>
                                <form action="{{ route('admin.portfolios.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus portofolio ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-red-50 hover:border-red-300 hover:text-red-600 text-slate-700 text-xs font-medium transition shadow-2xs" title="Hapus Portofolio">
                                        <x-icon name="trash" class="h-3.5 w-3.5 text-red-500" />
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">Belum ada portofolio yang tersimpan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
