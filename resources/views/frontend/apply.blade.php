@extends('layouts.frontend')

@section('content')

{{-- Page Header --}}
<div class="text-center mb-10">
    <span class="inline-block bg-light-blue/10 text-light-blue font-semibold text-sm px-4 py-1.5 rounded-full uppercase tracking-wider mb-3">
        Kujiunga na Chuo
    </span>
    <h1 class="text-4xl font-bold text-gray-800 mb-3">Ombi la Kujiunga</h1>
    <p class="text-gray-500 max-w-xl mx-auto text-lg">
        Jaza fomu hii kwa usahihi. Baada ya kuwasilisha, utaelekezwa kwenye ukurasa wa malipo ya ada ya fomu ya
        <strong class="text-light-blue">TSH 15,000</strong> kupitia Beem Mobile Money.
    </p>
</div>

{{-- Progress Steps --}}
<div class="flex items-center justify-center gap-0 mb-10 max-w-lg mx-auto">
    <div class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-full bg-light-blue text-white flex items-center justify-center font-bold text-sm shadow">1</div>
        <span class="text-xs mt-1 font-semibold text-light-blue">Taarifa</span>
    </div>
    <div class="flex-1 h-1 bg-gray-200 mx-2 rounded"></div>
    <div class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center font-bold text-sm">2</div>
        <span class="text-xs mt-1 text-gray-400">Malipo</span>
    </div>
    <div class="flex-1 h-1 bg-gray-200 mx-2 rounded"></div>
    <div class="flex flex-col items-center">
        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center font-bold text-sm">3</div>
        <span class="text-xs mt-1 text-gray-400">Uthibitisho</span>
    </div>
</div>

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
        <div class="flex items-start gap-3">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
            <div>
                <p class="font-semibold text-red-700 mb-1">Tafadhali sahihisha makosa yafuatayo:</p>
                <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

{{-- Application Form --}}
<form action="{{ route('apply.submit') }}" method="POST" class="space-y-8" id="applyForm">
    @csrf

    {{-- Section 1: Personal Info --}}
    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
        <h2 class="text-lg font-bold text-gray-700 mb-5 flex items-center gap-2">
            <span class="w-7 h-7 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold">1</span>
            Taarifa za Kibinafsi
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Full Name --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                    Jina Kamili <span class="text-red-500">*</span>
                </label>
                <input type="text" name="full_name" value="{{ old('full_name') }}"
                       placeholder="Mfano: Juma Ally Hassan"
                       class="w-full px-4 py-3 border {{ $errors->has('full_name') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-light-blue focus:border-transparent transition text-gray-800"
                       required>
                @error('full_name')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone --}}
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                    Namba ya Simu <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">+255</span>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}"
                           placeholder="7XX XXX XXX"
                           maxlength="12"
                           class="w-full pl-14 pr-4 py-3 border {{ $errors->has('phone_number') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-light-blue focus:border-transparent transition text-gray-800"
                           required>
                </div>
                <p class="text-gray-400 text-xs mt-1">Namba hii itatumika kupokea SMS ya malipo</p>
                @error('phone_number')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                    Barua Pepe <span class="text-gray-400 font-normal text-xs">(si lazima)</span>
                </label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="mfano@gmail.com"
                       class="w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-light-blue focus:border-transparent transition text-gray-800">
                @error('email')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Gender --}}
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                    Jinsia <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-4 mt-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="radio" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}
                               class="w-4 h-4 text-light-blue border-gray-300 focus:ring-light-blue" required>
                        <span class="text-gray-700 group-hover:text-light-blue transition text-sm font-medium">
                            <i class="fas fa-mars mr-1 text-blue-400"></i>Mwanaume
                        </span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="radio" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}
                               class="w-4 h-4 text-light-blue border-gray-300 focus:ring-light-blue">
                        <span class="text-gray-700 group-hover:text-light-blue transition text-sm font-medium">
                            <i class="fas fa-venus mr-1 text-pink-400"></i>Mwanamke
                        </span>
                    </label>
                </div>
                @error('gender')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Date of Birth --}}
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                    Tarehe ya Kuzaliwa <span class="text-gray-400 font-normal text-xs">(si lazima)</span>
                </label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                       max="{{ date('Y-m-d', strtotime('-14 years')) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-light-blue focus:border-transparent transition text-gray-800">
            </div>

        </div>
    </div>

    {{-- Section 2: Course Selection --}}
    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
        <h2 class="text-lg font-bold text-gray-700 mb-5 flex items-center gap-2">
            <span class="w-7 h-7 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold">2</span>
            Chaguo la Kozi
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Course Type --}}
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                    Aina ya Kozi <span class="text-red-500">*</span>
                </label>
                <select name="course_type" id="courseType"
                        class="w-full px-4 py-3 border {{ $errors->has('course_type') ? 'border-red-400' : 'border-gray-300' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-light-blue focus:border-transparent transition text-gray-800 bg-white"
                        required>
                    <option value="">-- Chagua Aina --</option>
                    <option value="muda_mrefu" {{ old('course_type') == 'muda_mrefu' ? 'selected' : '' }}>Kozi za Muda Mrefu (Miaka 2)</option>
                    <option value="muda_mfupi" {{ old('course_type') == 'muda_mfupi' ? 'selected' : '' }}>Kozi za Muda Mfupi (Miezi 6)</option>
                </select>
                @error('course_type')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Course Name --}}
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                    Kozi Unayoomba <span class="text-red-500">*</span>
                </label>
                <select name="course_applied" id="courseApplied"
                        class="w-full px-4 py-3 border {{ $errors->has('course_applied') ? 'border-red-400' : 'border-gray-300' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-light-blue focus:border-transparent transition text-gray-800 bg-white"
                        required>
                    <option value="">-- Kwanza chagua aina ya kozi --</option>
                    {{-- Populated by JS based on course_type --}}
                    @if(old('course_applied'))
                        <option value="{{ old('course_applied') }}" selected>{{ old('course_applied') }}</option>
                    @endif
                </select>
                @error('course_applied')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    {{-- Section 3: Payment Summary --}}
    <div class="bg-gradient-to-r from-light-blue/5 to-blue-50 rounded-2xl p-6 border border-light-blue/20">
        <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
            <span class="w-7 h-7 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold">3</span>
            Muhtasari wa Malipo
        </h2>
        <div class="flex items-center justify-between py-3 border-b border-light-blue/20">
            <span class="text-gray-600">Ada ya Fomu ya Maombi</span>
            <span class="font-bold text-gray-800">TSH 15,000</span>
        </div>
        <div class="flex items-center justify-between py-3">
            <span class="text-gray-600 font-semibold">Jumla ya Kulipa</span>
            <span class="text-2xl font-bold text-light-blue">TSH 15,000</span>
        </div>
        <div class="mt-3 flex items-start gap-2 text-sm text-gray-500 bg-white rounded-xl p-3 border border-gray-100">
            <i class="fas fa-info-circle text-light-blue mt-0.5 flex-shrink-0"></i>
            <span>Baada ya kuwasilisha fomu hii, utapokea ujumbe wa USSD/SMS kutoka Beem kwenye namba yako ya simu ili kukamilisha malipo. Fomu yako itafunguliwa mara malipo yatakapothibitishwa.</span>
        </div>
    </div>

    {{-- Terms & Submit --}}
    <div class="space-y-4">
        <label class="flex items-start gap-3 cursor-pointer group">
            <input type="checkbox" name="terms" id="terms"
                   class="w-4 h-4 mt-0.5 text-light-blue border-gray-300 rounded focus:ring-light-blue flex-shrink-0"
                   required>
            <span class="text-sm text-gray-600">
                Nakubali
                <a href="{{ route('frontend.masharti') }}" target="_blank" class="text-light-blue hover:underline font-medium">Masharti ya Matumizi</a>
                na
                <a href="{{ route('frontend.faragha') }}" target="_blank" class="text-light-blue hover:underline font-medium">Sera ya Faragha</a>
                ya Kigamboni FDC. Nathibitisha kwamba taarifa nilizotoa ni za kweli.
            </span>
        </label>

        <button type="submit" id="submitBtn"
                class="w-full bg-light-blue hover:bg-blue-600 text-white font-bold py-4 px-8 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 text-lg">
            <i class="fas fa-paper-plane"></i>
            Wasilisha Ombi &amp; Endelea na Malipo
        </button>

        <p class="text-center text-xs text-gray-400">
            <i class="fas fa-lock mr-1"></i>
            Taarifa zako zinalindwa na SSL. Malipo yanafanywa kwa usalama kupitia Beem Africa.
        </p>
    </div>

</form>

@endsection

@section('script')
<script>
$(document).ready(function () {

    console.log('[KgFDC] apply.blade.php script loaded — jQuery version:', $.fn.jquery);

    const oldCourseType    = "{{ old('course_type') }}";
    const oldCourseApplied = "{{ old('course_applied') }}";

    // ── Load courses via AJAX whenever the type dropdown changes ──────────
    $('#courseType').on('change', function () {
        const selected = $(this).val();
        console.log('[KgFDC] courseType changed to:', selected);
        loadCourses(selected, null);
    });

    // ── On page load: restore selections after a validation failure ───────
    if (oldCourseType) {
        console.log('[KgFDC] Restoring old course_type:', oldCourseType);
        $('#courseType').val(oldCourseType);
        loadCourses(oldCourseType, oldCourseApplied);
    }

    // ── Prevent double-submit ─────────────────────────────────────────────
    $('#applyForm').on('submit', function () {
        const btn = $('#submitBtn');
        btn.prop('disabled', true)
           .html('<i class="fas fa-spinner fa-spin mr-2"></i> Inawasilisha...');
    });

    // ── Helper: fetch courses and populate the second dropdown ────────────
    function loadCourses(type, preselect) {
        const $select = $('#courseApplied');

        if (!type) {
            $select.html('<option value="">-- Kwanza chagua aina ya kozi --</option>');
            return;
        }

        console.log('[KgFDC] Fetching courses for type:', type);
        $select.html('<option value="">Inapakia...</option>').prop('disabled', true);

        $.ajax({
            url: '/get-courses/' + type,
            method: 'GET',
            dataType: 'json',
            success: function (courses) {
                console.log('[KgFDC] Courses received:', courses);
                $select.html('<option value="">-- Chagua Kozi --</option>');
                $.each(courses, function (i, course) {
                    const selected = (course === preselect) ? ' selected' : '';
                    $select.append('<option value="' + course + '"' + selected + '>' + course + '</option>');
                });
                $select.prop('disabled', false);
            },
            error: function (xhr, status, error) {
                console.error('[KgFDC] AJAX error:', status, error, xhr.responseText);
                $select.html('<option value="">Hitilafu — jaribu tena</option>').prop('disabled', false);
            }
        });
    }

});
</script>
@endsection
