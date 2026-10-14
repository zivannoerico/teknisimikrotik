@extends('layouts.app')

@section('title', 'Tentang Kami - TEKNISI MIKROTIK INDONESIA')
@section('meta_description', 'Spesialis jasa setting dan konfigurasi jaringan MikroTik RouterOS berorientasi pada stabilitas, keamanan, dan efisiensi operasional.')

@section('content')
{{-- 1. Hero Section --}}
<section class="border-b border-slate-200/80 bg-white py-14 sm:py-18">
    <div class="wrap">
        <div class="max-w-3xl text-left">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-700">
                Profil &amp; Pendekatan Kerja
            </span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold tracking-tight text-navy-900 leading-tight">
                Tentang TEKNISIMIKROTIK
            </h1>
            <p class="mt-3 text-base sm:text-lg leading-relaxed text-slate-600">
                Spesialis jasa konfigurasi, optimasi, dan penanganan infrastruktur jaringan komputer berbasis MikroTik RouterOS di Indonesia.
            </p>
        </div>
    </div>
</section>

{{-- 2. Identitas, Fokus Layanan & Prinsip --}}
<section class="section bg-surface" aria-labelledby="about-focus-title">
    <div class="wrap space-y-14 sm:space-y-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
            {{-- Kolom Kiri: Narasi Fokus & Komitmen --}}
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-xs font-bold text-blue-700 uppercase tracking-wider block">Fokus &amp; Komitmen</span>
                    <h2 id="about-focus-title" class="mt-2 text-2xl sm:text-3xl font-extrabold font-heading text-navy-900 leading-snug">
                        Membantu Bisnis Menikmati Koneksi Jaringan yang Terkontrol &amp; Stabil
                    </h2>
                </div>

                <div class="text-slate-700 text-sm sm:text-base leading-relaxed space-y-4">
                    <p>
                        <strong>TEKNISIMIKROTIK</strong> berfokus pada penyelesaian kendala koneksi internet dan manajemen lalu lintas data untuk berbagai skala usaha. Kami memahami bahwa koneksi internet yang sering putus, rebutan bandwidth, atau tidak terkontrol dapat mengganggu produktivitas karyawan dan menurunkan kepuasan pelanggan bisnis Anda.
                    </p>
                    <p>
                        Oleh karena itu, pendekatan kami tidak sekadar membuat router terhubung ke internet. Kami menganalisis kebutuhan beban kerja spesifik Anda, memetakan pembagian jalur ISP, mengatur alokasi bandwidth prioritas untuk aplikasi penting (seperti Zoom dan ERP), serta menerapkan konfigurasi keamanan RouterOS agar sistem terlindungi dari akses tidak sah.
                    </p>
                </div>

                {{-- Sektor Klien --}}
                <div class="border-t border-slate-200/80 pt-6">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3.5">Sektor yang Kami Layani:</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs sm:text-sm text-navy-900 font-semibold">
                        <div class="p-3 bg-white rounded-xl border border-slate-200/90 flex items-center gap-2 shadow-2xs">
                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0" />
                            <span>Perkantoran</span>
                        </div>
                        <div class="p-3 bg-white rounded-xl border border-slate-200/90 flex items-center gap-2 shadow-2xs">
                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0" />
                            <span>Warnet &amp; Cafe</span>
                        </div>
                        <div class="p-3 bg-white rounded-xl border border-slate-200/90 flex items-center gap-2 shadow-2xs">
                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0" />
                            <span>RT/RW Net</span>
                        </div>
                        <div class="p-3 bg-white rounded-xl border border-slate-200/90 flex items-center gap-2 shadow-2xs">
                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0" />
                            <span>Hotel &amp; Kos</span>
                        </div>
                        <div class="p-3 bg-white rounded-xl border border-slate-200/90 flex items-center gap-2 shadow-2xs">
                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0" />
                            <span>Sekolah &amp; Kampus</span>
                        </div>
                        <div class="p-3 bg-white rounded-xl border border-slate-200/90 flex items-center gap-2 shadow-2xs">
                            <x-icon name="check" class="h-4 w-4 text-blue-600 shrink-0" />
                            <span>Gudang &amp; Ruko</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Prinsip Kerja --}}
            <div class="lg:col-span-5">
                <div class="bg-white rounded-2xl border border-slate-200/90 p-7 sm:p-8 space-y-6 shadow-2xs">
                    <div class="border-b border-slate-100 pb-4">
                        <h3 class="text-lg sm:text-xl font-bold font-heading text-navy-900">
                            Prinsip Kerja &amp; Komunikasi
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            Standar etika dan pelayanan yang kami pegang untuk setiap klien:
                        </p>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                            <h4 class="font-bold text-navy-900 text-sm sm:text-base">Bahasa yang Mudah Dipahami</h4>
                            <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                Kami menjelaskan opsi konfigurasi dengan bahasa sederhana agar pemilik usaha non-teknis dapat mengambil keputusan dengan tepat.
                            </p>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                            <h4 class="font-bold text-navy-900 text-sm sm:text-base">Transparansi Penuh</h4>
                            <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                Seluruh akun dan password router diserahkan utuh kepada pemilik. File cadangan konfigurasi diberikan lengkap tanpa lock.
                            </p>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                            <h4 class="font-bold text-navy-900 text-sm sm:text-base">Uji Beban Bersama</h4>
                            <p class="text-slate-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                Sebelum serah terima, kami mendampingi simulasi pengujian koneksi bersama Anda untuk memastikan kestabilan sistem di lapangan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4 Langkah Alur Kerja --}}
        <div class="pt-10 border-t border-slate-200/80">
            <div class="max-w-2xl text-left mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-700">Metode Kerja</span>
                <h3 class="text-2xl sm:text-3xl font-extrabold font-heading text-navy-900 mt-1">Bagaimana Kami Bekerja</h3>
                <p class="text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">Proses pengerjaan terarah dari pemetaan masalah hingga penyerahan file konfigurasi.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200/90 space-y-3 shadow-2xs">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 font-mono text-sm font-bold text-blue-700">1</span>
                    <h4 class="font-heading font-bold text-base text-navy-900">Diagnosa Kebutuhan</h4>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Mempelajari model router, kapasitas ISP, dan kendala spesifik yang dihadapi pengguna.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200/90 space-y-3 shadow-2xs">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 font-mono text-sm font-bold text-blue-700">2</span>
                    <h4 class="font-heading font-bold text-base text-navy-900">Perancangan Skema</h4>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Menyusun arsitektur alokasi bandwidth, rute failover, dan segmentasi IP yang tepat guna.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200/90 space-y-3 shadow-2xs">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 font-mono text-sm font-bold text-blue-700">3</span>
                    <h4 class="font-heading font-bold text-base text-navy-900">Konfigurasi Langsung</h4>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Penerapan parameter RouterOS secara live remote terenkripsi atau on-site visit.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200/90 space-y-3 shadow-2xs">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 font-mono text-sm font-bold text-blue-700">4</span>
                    <h4 class="font-heading font-bold text-base text-navy-900">Serah Terima &amp; Backup</h4>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Pengujian beban bersama klien serta penyerahan file backup konfigurasi (.backup dan .rsc).
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. CTA WhatsApp --}}
<section class="section-compact bg-navy-900 text-white">
    <div class="wrap text-center">
        <h2 class="text-2xl sm:text-3xl font-extrabold sm:text-4xl">Ingin Berkonsultasi Mengenai Jaringan Anda?</h2>
        <p class="mx-auto mt-3 max-w-2xl text-sm sm:text-base text-slate-300 leading-relaxed">
            Ceritakan kondisi dan kendala jaringan tempat usaha Anda kepada kami. Kami siap membantu mencari solusi yang paling tepat.
        </p>
        <div class="mt-7 flex justify-center">
            <a href="{{ $waLink('Halo, saya ingin konsultasi mengenai kebutuhan jaringan MikroTik.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-wa btn-lg">
                <x-icon name="whatsapp" class="h-5 w-5" />
                <span>Konsultasi via WhatsApp</span>
            </a>
        </div>
    </div>
</section>
@endsection
