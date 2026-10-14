@extends('layouts.app')

@section('title', 'Layanan Jasa Setting MikroTik Lengkap & Terpercaya')
@section('meta_description', 'Katalog lengkap layanan jasa setting MikroTik: Multi-ISP Load Balancing, Bandwidth Management QoS, Hotspot Voucher, VPN, Firewall, dan VLAN.')

@section('content')
{{-- 1. Hero Layanan --}}
<section class="border-b border-slate-200/80 bg-white py-14 sm:py-18">
    <div class="wrap">
        <div class="max-w-3xl text-left">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                Katalog Layanan Spesialis
            </span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Layanan Konfigurasi &amp; Optimasi MikroTik
            </h1>
            <p class="mt-3 text-base sm:text-lg leading-relaxed text-slate-600">
                Solusi penanganan infrastruktur RouterOS yang dirancang khusus untuk stabilitas, efisiensi bandwidth, dan keamanan koneksi tempat usaha Anda.
            </p>

            <div class="mt-6 flex flex-wrap items-center gap-y-2 gap-x-6 text-xs sm:text-sm text-slate-600">
                <span class="flex items-center gap-1.5">
                    <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0" />
                    <span>Live Remote AnyDesk / TeamViewer</span>
                </span>
                <span class="flex items-center gap-1.5">
                    <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0" />
                    <span>Kunjungan On-Site Wilayah Tertentu</span>
                </span>
                <span class="flex items-center gap-1.5">
                    <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0" />
                    <span>Garansi &amp; Backup Script Lengkap</span>
                </span>
            </div>
        </div>
    </div>
</section>

{{-- 2. Daftar Layanan --}}
<section class="section bg-surface" aria-labelledby="services-list-title">
    <div class="wrap">
        <div class="max-w-2xl text-left mb-10 sm:mb-12">
            <h2 id="services-list-title" class="text-2xl sm:text-3xl font-extrabold tracking-tight text-navy-900 leading-tight">
                Pilihan Spesialisasi Layanan
            </h2>
            <p class="mt-2 text-sm sm:text-base leading-relaxed text-slate-600">
                Pilih spesialisasi yang sesuai dengan kebutuhan dan kendala operasional jaringan Anda saat ini.
            </p>
        </div>

        <div class="grid gap-6 sm:gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $service)
                <article class="flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-7 shadow-2xs transition-all hover:border-blue-500 hover:shadow-xs">
                    <div>
                        {{-- Header Item --}}
                        <div class="flex items-center justify-between gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700 shrink-0">
                                @if(str_contains($service->slug, 'load-balancing'))
                                    <x-icon name="network" class="h-5 w-5" />
                                @elseif(str_contains($service->slug, 'bandwidth') || str_contains($service->slug, 'qos'))
                                    <x-icon name="gauge" class="h-5 w-5" />
                                @elseif(str_contains($service->slug, 'hotspot'))
                                    <x-icon name="wifi" class="h-5 w-5" />
                                @elseif(str_contains($service->slug, 'vpn') || str_contains($service->slug, 'firewall'))
                                    <x-icon name="shield" class="h-5 w-5" />
                                @elseif(str_contains($service->slug, 'vlan'))
                                    <x-icon name="layers" class="h-5 w-5" />
                                @else
                                    <x-icon name="topology" class="h-5 w-5" />
                                @endif
                            </span>

                            @if($service->badge)
                                <span class="rounded-full bg-slate-100 px-3 py-0.5 text-xs font-semibold text-slate-700 border border-slate-200">
                                    {{ $service->badge }}
                                </span>
                            @elseif(!empty($service->price_start))
                                <span class="rounded-md bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-700">
                                    Mulai {{ $service->price_start }}
                                </span>
                            @endif
                        </div>

                        {{-- Judul & Deskripsi --}}
                        <h3 class="mt-4 text-lg sm:text-xl font-bold leading-snug text-navy-900">
                            <a href="{{ route('services.show', $service->slug) }}" class="transition-colors hover:text-blue-600">
                                {{ $service->title }}
                            </a>
                        </h3>

                        <p class="mt-2 text-sm leading-relaxed text-slate-600">
                            {{ $service->short_description }}
                        </p>

                        {{-- Cakupan Pekerjaan --}}
                        @if(!empty($service->features))
                            <div class="mt-5 border-t border-slate-100 pt-4">
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Cakupan Layanan:</p>
                                <ul class="mt-2.5 space-y-2 text-xs sm:text-sm text-slate-700">
                                    @foreach(array_slice($service->features, 0, 3) as $f)
                                        <li class="flex items-start gap-2">
                                            <x-icon name="check" class="mt-0.5 h-3.5 w-3.5 shrink-0 text-blue-600" />
                                            <span>{{ $f }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    {{-- Footer & Action Links --}}
                    <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between gap-3">
                        <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-blue-700 hover:text-navy-900 transition-colors">
                            <span>Detail Layanan</span>
                            <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                        </a>
                        <a href="{{ route('consultation.create', ['service' => $service->title]) }}" class="btn btn-outline btn-sm">
                            Konsultasikan
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- 3. Gambaran Alur Pengerjaan --}}
<section class="section bg-white border-t border-slate-200/80">
    <div class="wrap">
        <div class="max-w-2xl text-left mb-10 sm:mb-12">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-700">Tahapan Pengerjaan</span>
            <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-navy-900 leading-tight">
                Bagaimana Kami Menangani Jaringan Anda
            </h2>
            <p class="mt-2 text-sm sm:text-base leading-relaxed text-slate-600">
                Langkah transparan dari diagnosa kendala hingga serah terima file konfigurasi cadangan.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-slate-200/90 bg-surface p-6">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 font-mono text-sm font-bold text-blue-700">1</span>
                <h3 class="mt-4 text-base font-bold text-navy-900">Konsultasi Awal</h3>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 leading-relaxed">Diskusi mengenai masalah yang terjadi, kapasitas bandwidth, dan model router MikroTik yang digunakan.</p>
            </div>
            <div class="rounded-2xl border border-slate-200/90 bg-surface p-6">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 font-mono text-sm font-bold text-blue-700">2</span>
                <h3 class="mt-4 text-base font-bold text-navy-900">Rencana Skema</h3>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 leading-relaxed">Penyusunan arsitektur topologi dan penentuan metode pengerjaan (live remote terenkripsi atau onsite visit).</p>
            </div>
            <div class="rounded-2xl border border-slate-200/90 bg-surface p-6">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 font-mono text-sm font-bold text-blue-700">3</span>
                <h3 class="mt-4 text-base font-bold text-navy-900">Eksekusi Setting</h3>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 leading-relaxed">Penerapan parameter RouterOS secara langsung dan terarah sesuai kebutuhan yang disepakati.</p>
            </div>
            <div class="rounded-2xl border border-slate-200/90 bg-surface p-6">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 font-mono text-sm font-bold text-blue-700">4</span>
                <h3 class="mt-4 text-base font-bold text-navy-900">Uji Beban &amp; Backup</h3>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 leading-relaxed">Pengujian koneksi bersama klien, penyerahan file cadangan (.backup &amp; .rsc), dan masa pendampingan.</p>
            </div>
        </div>
    </div>
</section>

{{-- 4. CTA Konsultasi --}}
<section class="section-compact bg-navy-900 text-white">
    <div class="wrap text-center">
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight sm:text-4xl">
            Butuh Rekomendasi Solusi untuk Jaringan Anda?
        </h2>
        <p class="mx-auto mt-3 max-w-2xl text-sm sm:text-base text-slate-300 leading-relaxed">
            Diskusikan kebutuhan jaringan Anda langsung dengan kami. Kami siap membantu menganalisis konfigurasi yang tepat.
        </p>
        <div class="mt-7 flex flex-col items-center justify-center gap-3.5 sm:flex-row">
            <a href="{{ $waLink('Halo, saya ingin konsultasi layanan setting MikroTik.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-lg">
                <x-icon name="whatsapp" class="h-5 w-5" />
                <span>Konsultasi via WhatsApp</span>
            </a>
            <a href="{{ route('consultation.create') }}" class="btn btn-outline-light btn-lg">
                <span>Isi Formulir Konsultasi</span>
            </a>
        </div>
    </div>
</section>
@endsection
