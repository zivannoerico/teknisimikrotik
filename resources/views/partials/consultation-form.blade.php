{{--
    Consultation form shared by the homepage and /konsultasi.

    @param \Illuminate\Support\Collection<int, string> $serviceOptions  Active service titles for the dropdown
    @param string|null $selectedService  Pre-selected service title
    @param bool $extended  Show the optional extra fields (company, router model, ISP count, email)
    @param string $formId  Unique DOM id prefix
--}}
@php
    $extended = $extended ?? false;
    $selectedService = $selectedService ?? null;
    $formId = $formId ?? 'consultation';
    $chosenService = old('service_type', $selectedService);
    $userCountOptions = ['1-10 user/perangkat', '11-25 user/perangkat', '26-50 user/perangkat', '51-100 user/perangkat', 'Lebih dari 100', 'Belum tahu'];
    $serviceChoices = $serviceOptions->push('Lainnya / belum tahu')->unique()->values();
@endphp

<form id="{{ $formId }}-form" action="{{ route('consultation.store') }}" method="POST" class="grid gap-5" data-scroll-on-error="{{ $errors->any() ? 'true' : 'false' }}">
    @csrf

    @if ($errors->any())
        <div role="alert" class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-base text-red-800">
            Formulir belum terkirim. Mohon periksa kembali isian yang ditandai.
        </div>
    @endif

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="{{ $formId }}-name" class="label">Nama</label>
            <input id="{{ $formId }}-name" name="name" type="text" value="{{ old('name') }}" required maxlength="100" autocomplete="name" class="field" placeholder="Nama Anda" @error('name') aria-invalid="true" aria-describedby="{{ $formId }}-name-error" @enderror>
            @error('name')<p id="{{ $formId }}-name-error" class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="{{ $formId }}-phone" class="label">Nomor WhatsApp</label>
            <input id="{{ $formId }}-phone" name="phone" type="tel" inputmode="tel" value="{{ old('phone') }}" required maxlength="25" autocomplete="tel" class="field" placeholder="0812xxxxxxxx" @error('phone') aria-invalid="true" aria-describedby="{{ $formId }}-phone-error" @enderror>
            @error('phone')<p id="{{ $formId }}-phone-error" class="field-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="{{ $formId }}-service" class="label">Jenis kebutuhan</label>
            <select id="{{ $formId }}-service" name="service_type" required class="field" @error('service_type') aria-invalid="true" aria-describedby="{{ $formId }}-service-error" @enderror>
                <option value="" disabled @selected(! $chosenService)>Pilih kebutuhan</option>
                @foreach ($serviceChoices as $option)
                    <option value="{{ $option }}" @selected($chosenService === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('service_type')<p id="{{ $formId }}-service-error" class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="{{ $formId }}-users" class="label">Jumlah user / perangkat</label>
            <select id="{{ $formId }}-users" name="user_count" class="field" @error('user_count') aria-invalid="true" @enderror>
                <option value="">Pilih perkiraan</option>
                @foreach ($userCountOptions as $option)
                    <option value="{{ $option }}" @selected(old('user_count') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('user_count')<p class="field-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label for="{{ $formId }}-problem" class="label">Deskripsi masalah</label>
        <textarea id="{{ $formId }}-problem" name="problem_description" rows="4" required minlength="10" maxlength="2000" class="field" placeholder="Contoh: internet sering putus saat jam kerja, ingin pakai 2 ISP." @error('problem_description') aria-invalid="true" aria-describedby="{{ $formId }}-problem-error" @enderror>{{ old('problem_description') }}</textarea>
        @error('problem_description')<p id="{{ $formId }}-problem-error" class="field-error">{{ $message }}</p>@enderror
    </div>

    @if ($extended)
        <details class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3" @if ($errors->hasAny(['email', 'company_or_institution', 'mikrotik_model', 'isp_count'])) open @endif>
            <summary class="cursor-pointer text-base font-semibold text-navy-900">Informasi tambahan (opsional)</summary>
            <div class="mt-4 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="{{ $formId }}-company" class="label">Perusahaan / instansi</label>
                    <input id="{{ $formId }}-company" name="company_or_institution" type="text" value="{{ old('company_or_institution') }}" maxlength="150" class="field">
                    @error('company_or_institution')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="{{ $formId }}-email" class="label">Email</label>
                    <input id="{{ $formId }}-email" name="email" type="email" value="{{ old('email') }}" maxlength="100" autocomplete="email" class="field" @error('email') aria-invalid="true" @enderror>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="{{ $formId }}-model" class="label">Tipe router MikroTik</label>
                    <input id="{{ $formId }}-model" name="mikrotik_model" type="text" value="{{ old('mikrotik_model') }}" maxlength="100" class="field" placeholder="mis. hEX, RB4011, CCR2004">
                    @error('mikrotik_model')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="{{ $formId }}-isp" class="label">Jumlah ISP</label>
                    <input id="{{ $formId }}-isp" name="isp_count" type="text" value="{{ old('isp_count') }}" maxlength="50" class="field" placeholder="mis. 2 provider">
                    @error('isp_count')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>
        </details>
    @endif

    <div class="pt-1">
        <button type="submit" class="btn btn-wa btn-block inline-flex items-center justify-center gap-2 py-2.5 px-4 min-h-[2.75rem] text-sm font-semibold">
            <x-icon name="whatsapp" class="h-4 w-4 shrink-0" />
            <span>Chat WhatsApp</span>
        </button>
    </div>
</form>
