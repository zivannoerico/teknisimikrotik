@extends('layouts.admin')

@section('title', $isEdit ? 'Edit FAQ' : 'Tambah FAQ')
@section('page_title', $isEdit ? 'Edit FAQ' : 'Tambah FAQ Baru')

@section('content')
<div class="space-y-6">
    {{-- Header Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-200/80 pb-4">
        <div>
            <h2 class="text-xl font-bold font-heading text-navy-900">
                {{ $isEdit ? 'Edit Tanya Jawab (FAQ)' : 'Tambah FAQ Baru' }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Tuliskan pertanyaan umum dan penjelasan resmi seputar layanan untuk pengunjung website.</p>
        </div>
        <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-slate-600 hover:text-navy-900 transition-colors">
            <x-icon name="arrow-left" class="h-4 w-4" />
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}" method="POST">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
            {{-- Kolom Kiri: Pertanyaan & Jawaban Utama (8 Kolom) --}}
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs space-y-5">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-navy-900 uppercase tracking-wider">Konten Tanya Jawab</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pertanyaan yang sering ditanyakan dan jawaban penjelasan yang transparan.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="question" class="label">Pertanyaan <span class="text-rose-500">*</span></label>
                            <input type="text" id="question" name="question" value="{{ old('question', $faq->question) }}" required placeholder="Contoh: Bagaimana mekanisme remote setting router MikroTik?" class="field" @error('question') aria-invalid="true" @enderror>
                            @error('question')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="answer" class="label">Jawaban Lengkap <span class="text-rose-500">*</span></label>
                            <textarea id="answer" name="answer" rows="7" required placeholder="Jelaskan jawaban secara rinci, transparan, dan mudah dipahami oleh pemilik usaha..." class="field leading-relaxed p-4" @error('answer') aria-invalid="true" @enderror>{{ old('answer', $faq->answer) }}</textarea>
                            @error('answer')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Pengaturan & Aksi (4 Kolom) --}}
            <div class="lg:col-span-4 space-y-6">
                {{-- Card 1: Pengaturan Tampilan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-7 shadow-2xs space-y-4">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100 pb-3 font-mono">
                        Pengaturan Tampilan
                    </h3>

                    <div>
                        <label for="sort_order" class="label">Nomor Urutan Tampil</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}" min="0" class="field font-mono" @error('sort_order') aria-invalid="true" @enderror>
                        <span class="text-[11px] text-slate-400 mt-1 block">Urutan angka lebih kecil tampil paling atas (0, 1, 2, ...).</span>
                        @error('sort_order')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-2 border-t border-slate-100">
                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-4 w-4">
                            <span class="text-xs sm:text-sm font-semibold text-slate-800">FAQ Aktif Ditampilkan</span>
                        </label>
                    </div>
                </div>

                {{-- Card 2: Tombol Aksi Simpan --}}
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-2xs space-y-3">
                    <button type="submit" class="btn btn-primary btn-block text-sm min-h-[2.875rem]">
                        {{ $isEdit ? 'Simpan Perubahan FAQ' : 'Terbitkan FAQ Sekarang' }}
                    </button>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline btn-block text-xs sm:text-sm">
                        Batal &amp; Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
