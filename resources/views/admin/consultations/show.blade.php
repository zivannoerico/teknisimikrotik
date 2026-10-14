@extends('layouts.admin')

@section('title', 'Detail Konsultasi #' . str_pad($consultation->id, 5, '0', STR_PAD_LEFT))
@section('page_title', 'Rincian Tiket Konsultasi #' . str_pad($consultation->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div class="space-y-6">
    {{-- Top Back Nav & Timestamp --}}
    <div class="flex items-center justify-between gap-4">
        <a href="{{ route('admin.consultations.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-slate-600 hover:text-navy-900 transition-colors">
            <x-icon name="arrow-left" class="h-4 w-4" />
            <span>Kembali ke Daftar Konsultasi</span>
        </a>
        <span class="font-mono text-xs text-slate-400">Diterima: {{ $consultation->created_at->format('d F Y, H:i') }} WIB</span>
    </div>

    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
        {{-- Left Area: Main Ticket Information & Actions (8 cols) --}}
        <div class="lg:col-span-8 space-y-6">
            {{-- Card 1: Detail Keluhan Jaringan --}}
            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-2xs space-y-6">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-5">
                    <div>
                        <span class="text-xs font-mono text-blue-700 font-bold uppercase tracking-wider">Tiket Konsultasi #{{ str_pad($consultation->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <h2 class="text-xl sm:text-2xl font-bold font-heading text-navy-900 mt-1">{{ $consultation->service_type }}</h2>
                    </div>
                    <div class="shrink-0">
                        @if($consultation->status == 'baru')
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200/80 font-bold uppercase text-xs">Baru</span>
                        @elseif($consultation->status == 'diproses')
                            <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200/80 font-bold uppercase text-xs">Sedang Diproses</span>
                        @elseif($consultation->status == 'selesai')
                            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/80 font-bold uppercase text-xs">Selesai</span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 font-bold uppercase text-xs">Dibatalkan</span>
                        @endif
                    </div>
                </div>

                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-500 uppercase font-mono block">Uraian Kendala / Kebutuhan Jaringan:</span>
                    <div class="p-4 sm:p-5 rounded-xl bg-slate-50 border border-slate-200/80 text-sm sm:text-base text-slate-800 leading-relaxed whitespace-pre-line">
                        {{ $consultation->problem_description }}
                    </div>
                </div>

                {{-- Parameter Teknis --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                        <span class="text-slate-400 block uppercase font-mono text-[10px] font-semibold">Tipe Router</span>
                        <span class="text-navy-900 font-bold text-sm mt-1 block font-mono">{{ $consultation->mikrotik_model ?: 'Belum ditentukan' }}</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                        <span class="text-slate-400 block uppercase font-mono text-[10px] font-semibold">Jumlah ISP</span>
                        <span class="text-navy-900 font-bold text-sm mt-1 block">{{ $consultation->isp_count ?: '1 Provider' }}</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                        <span class="text-slate-400 block uppercase font-mono text-[10px] font-semibold">Jumlah User</span>
                        <span class="text-navy-900 font-bold text-sm mt-1 block">{{ $consultation->user_count ?: '-' }}</span>
                    </div>
                </div>
            </div>

            {{-- Card 2: Form Tindak Lanjut & Catatan Teknisi --}}
            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-2xs space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <h3 class="text-base sm:text-lg font-bold font-heading text-navy-900">Catatan Internal &amp; Update Status</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Catatan hanya dapat dilihat oleh akun admin untuk tracking pengerjaan.</p>
                </div>

                <form action="{{ route('admin.consultations.update', $consultation->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="status" class="label">Status Tiket Konsultasi</label>
                        <select id="status" name="status" class="field">
                            <option value="baru" {{ $consultation->status == 'baru' ? 'selected' : '' }}>Baru (Belum Dihubungi)</option>
                            <option value="diproses" {{ $consultation->status == 'diproses' ? 'selected' : '' }}>Diproses (Sedang Diskusi / Setting Remote)</option>
                            <option value="selesai" {{ $consultation->status == 'selesai' ? 'selected' : '' }}>Selesai (Pengerjaan &amp; Uji Coba Berhasil)</option>
                            <option value="dibatalkan" {{ $consultation->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label for="admin_notes" class="label">Catatan Tindak Lanjut Teknisi</label>
                        <textarea id="admin_notes" name="admin_notes" rows="4" placeholder="Contoh: Sudah dihubungi via WA. Dijadwalkan remote setting Selasa malam jam 20.00 WIB via AnyDesk..." class="field leading-relaxed">{{ old('admin_notes', $consultation->admin_notes) }}</textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary text-xs sm:text-sm px-6 py-2.5 shadow-xs">
                            Simpan Perubahan &amp; Catatan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Right Area: Client Profile & Quick Contact (4 cols) --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 shadow-2xs space-y-5 sticky top-24">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3">
                    Profil Klien Pemohon
                </h3>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div>
                        <span class="text-slate-400 block uppercase font-mono text-[10px] font-semibold">Nama Klien</span>
                        <span class="text-navy-900 font-bold text-sm sm:text-base block mt-0.5">{{ $consultation->name }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 block uppercase font-mono text-[10px] font-semibold">Nomor WhatsApp</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $consultation->phone) }}?text=Halo%20{{ rawurlencode($consultation->name) }},%20kami%20dari%20Teknisi%20MikroTik%20menindaklanjuti%20permohonan%20konsultasi%20Anda." target="_blank" class="text-emerald-700 font-bold hover:underline inline-flex items-center gap-1.5 text-sm sm:text-base mt-0.5 font-mono">
                            <x-icon name="whatsapp" class="h-4 w-4 text-emerald-600" />
                            <span>{{ $consultation->phone }}</span>
                        </a>
                    </div>

                    @if($consultation->email)
                    <div>
                        <span class="text-slate-400 block uppercase font-mono text-[10px] font-semibold">Email Klien</span>
                        <a href="mailto:{{ $consultation->email }}" class="text-slate-700 hover:underline block mt-0.5 break-all">{{ $consultation->email }}</a>
                    </div>
                    @endif

                    <div>
                        <span class="text-slate-400 block uppercase font-mono text-[10px] font-semibold">Instansi / Perusahaan</span>
                        <span class="text-slate-700 font-medium block mt-0.5">{{ $consultation->company_or_institution ?: '-' }}</span>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $consultation->phone) }}?text=Halo%20{{ rawurlencode($consultation->name) }},%20kami%20dari%20Teknisi%20MikroTik%20menindaklanjuti%20permohonan%20konsultasi%20Anda." target="_blank" class="btn btn-wa btn-block text-xs sm:text-sm">
                        <x-icon name="whatsapp" class="h-4 w-4" />
                        <span>Chat WhatsApp Klien</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
