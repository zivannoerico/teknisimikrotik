@extends('layouts.app')

@section('title', $service->title . ' - Jasa Setting MikroTik')
@section('meta_description', $service->short_description)

@section('content')
<div class="bg-surface py-10 sm:py-14">
    <div class="wrap">
        {{-- Breadcrumb Navigation --}}
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-slate-500 mb-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-navy-900 transition-colors">Beranda</a>
            <x-icon name="chevron-right" class="h-3 w-3 text-slate-400" />
            <a href="{{ route('services.index') }}" class="hover:text-navy-900 transition-colors">Layanan</a>
            <x-icon name="chevron-right" class="h-3 w-3 text-slate-400" />
            <span class="text-navy-900 font-semibold truncate">{{ $service->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
            {{-- Main Content Area: Editorial Single-Surface Structure --}}
            <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200/90 p-7 sm:p-10 shadow-2xs space-y-10">
                {{-- Header Section --}}
                <div class="space-y-3 pb-8 border-b border-slate-100">
                    @if($service->badge)
                        <span class="px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-200/70 inline-block">
                            {{ $service->badge }}
                        </span>
                    @endif
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-navy-900 tracking-tight leading-tight">
                        {{ $service->title }}
                    </h1>
                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                        {{ $service->short_description }}
                    </p>
                </div>

                {{-- Ruang Lingkup & Penjelasan Teknis --}}
                <div class="space-y-4">
                    <h2 class="text-xl sm:text-2xl font-bold text-navy-900 tracking-tight">
                        Ruang Lingkup &amp; Penjelasan Teknis
                    </h2>
                    <div class="text-slate-700 text-base leading-relaxed space-y-4">
                        <p class="whitespace-pre-line">{{ $service->full_description ?? $service->short_description }}</p>
                    </div>
                </div>

                {{-- Siapa yang Membutuhkan Layanan Ini --}}
                <div class="space-y-3 pt-6 border-t border-slate-100">
                    <h3 class="text-lg sm:text-xl font-bold text-navy-900 tracking-tight">
                        Siapa yang Membutuhkan Layanan Ini?
                    </h3>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        Layanan ini sangat cocok untuk bisnis dan tempat operasional seperti perkantoran, warnet, RT/RW Net, kafe, restoran, hotel, sekolah, serta instansi yang memerlukan jaringan terkelola dengan kestabilan tinggi.
                    </p>
                </div>

                {{-- Deliverables & Parameter Konfigurasi --}}
                @if(!empty($service->features))
                    <div class="space-y-4 pt-6 border-t border-slate-100">
                        <h3 class="text-lg sm:text-xl font-bold text-navy-900 tracking-tight">
                            Cakupan Pekerjaan yang Diterapkan
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            @foreach($service->features as $item)
                                <div class="flex items-start gap-3 p-3.5 sm:p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                    <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0 mt-0.5" />
                                    <span class="text-xs sm:text-sm text-navy-900 font-medium leading-relaxed">{{ $item }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Pendampingan & Garansi --}}
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0 mt-0.5">
                        <x-icon name="shield" class="h-5 w-5" />
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-base font-bold text-navy-900">Pendampingan &amp; Backup Konfigurasi</h4>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Setiap pengerjaan mencakup pendampingan uji coba beban operasional dan penyerahan file backup konfigurasi RouterOS (.backup dan script .rsc) untuk arsip keamanan jaringan Anda.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Right Sidebar --}}
            <aside class="lg:col-span-4">
                <div class="space-y-6 lg:sticky lg:top-24">
                    {{-- Card 1: Biaya & Action --}}
                    <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-6">
                        <div>
                            <span class="text-xs text-slate-500 font-medium block">Biaya Jasa Mulai:</span>
                            <div class="text-2xl sm:text-3xl font-extrabold text-navy-900 mt-1">
                                {{ $service->price_start ?? 'Kontak Kami' }}
                            </div>
                            <span class="text-xs text-slate-500 block mt-1">Sekali setting &middot; Termasuk uji coba bersama</span>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-100">
                            <a href="{{ route('consultation.create', ['service' => $service->title]) }}" class="btn btn-primary btn-block text-sm">
                                Konsultasikan Layanan Ini
                            </a>
                            <a href="{{ $waLink('Halo Teknisi MikroTik, saya tertarik dengan layanan: ' . $service->title . '.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-block text-sm">
                                <x-icon name="whatsapp" class="h-4 w-4" />
                                <span>Chat WhatsApp</span>
                            </a>
                        </div>

                        <div class="pt-4 border-t border-slate-100 text-xs sm:text-sm text-slate-600 space-y-2.5">
                            <div class="flex items-center gap-2">
                                <x-icon name="check" class="h-4 w-4 text-emerald-600 font-bold shrink-0" />
                                <span>Live remote AnyDesk / TeamViewer</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-icon name="check" class="h-4 w-4 text-emerald-600 font-bold shrink-0" />
                                <span>Kunjungan on-site (wilayah tertentu)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-icon name="check" class="h-4 w-4 text-emerald-600 font-bold shrink-0" />
                                <span>Pemeriksaan hasil koneksi bersama klien</span>
                            </div>
                        </div>
                    </div>

                    {{-- Card 2: Layanan Terkait --}}
                    @if($otherServices->count() > 0)
                        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-2xs space-y-4">
                            <h4 class="text-xs font-bold text-navy-900 uppercase tracking-wider">Layanan Terkait Lainnya</h4>
                            <div class="space-y-2.5">
                                @foreach($otherServices as $os)
                                    <a href="{{ route('services.show', $os->slug) }}" class="block p-3 rounded-xl bg-slate-50 border border-slate-200/80 hover:border-slate-300 transition-colors">
                                        <span class="text-sm font-bold text-navy-900 block">{{ $os->title }}</span>
                                        <span class="text-xs text-slate-500 block mt-0.5">{{ $os->price_start ?? 'Hubungi Kami' }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
