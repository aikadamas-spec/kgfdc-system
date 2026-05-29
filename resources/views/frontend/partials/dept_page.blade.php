{{--
    Reusable Department Page Partial
    ─────────────────────────────────
    Required variables (pass via @include or component):
      $deptKey      — e.g. 'mechanic'  (used to build dept_mechanic_* keys)
      $deptImage    — e.g. 'ufundimagari.webp'
      $deptIcon     — FontAwesome class e.g. 'fa-car'
      $deptColor    — Tailwind bg class for hero gradient e.g. 'from-blue-700'
      $deptDuration — translation key e.g. 'dept_both_duration'
      $deptReq      — translation key e.g. 'dept_req_form4'
      $deptCert     — translation key e.g. 'dept_cert_nactvet'
--}}

<div class="max-w-4xl mx-auto">

    {{-- ── Animated Hero Banner ────────────────────────────────────────────── --}}
    <div class="relative rounded-3xl overflow-hidden mb-10 shadow-xl bg-gradient-to-br {{ $deptColor }} to-gray-900">
        {{-- Background image with overlay --}}
        <div class="absolute inset-0">
            <img src="{{ asset('frontend_assets/img/' . $deptImage) }}"
                 alt="{{ __('messages.dept_' . $deptKey . '_hero') }}"
                 class="w-full h-full object-cover opacity-25">
        </div>
        {{-- Content --}}
        <div class="relative z-10 px-8 py-14 md:py-20 text-white text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm mb-5 animate-pulse">
                <i class="fas {{ $deptIcon }} text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold mb-3 leading-tight">
                {{ __('messages.dept_' . $deptKey . '_hero') }}
            </h1>
            <p class="text-lg md:text-xl text-white/80 mb-8 max-w-2xl mx-auto">
                {{ __('messages.dept_' . $deptKey . '_tagline') }}
            </p>
            <a href="{{ route('apply.start') }}"
               class="inline-flex items-center gap-2 bg-white text-gray-900 font-bold px-8 py-4 rounded-xl hover:bg-yellow-300 transition shadow-lg hover:shadow-xl text-base">
                <i class="fas fa-file-alt"></i>
                {{ __('messages.dept_apply_cta') }}
            </a>
        </div>
    </div>

    {{-- ── Course Image with Hover Zoom ────────────────────────────────────── --}}
    <div class="overflow-hidden rounded-2xl shadow-lg mb-10 group">
        <img src="{{ asset('frontend_assets/img/' . $deptImage) }}"
             alt="{{ __('messages.dept_' . $deptKey . '_hero') }}"
             class="w-full h-72 md:h-96 object-cover group-hover:scale-105 transition-transform duration-500">
    </div>

    {{-- ── Description ─────────────────────────────────────────────────────── --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8 mb-10">
        <p class="text-gray-600 leading-relaxed text-justify text-base">
            {{ __('messages.dept_' . $deptKey . '_desc') }}
        </p>
    </div>

    {{-- ── 3-Column Info Grid ───────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">

        {{-- Card 1: Duration --}}
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 text-center hover:shadow-md transition group">
            <div class="w-12 h-12 rounded-full bg-light-blue text-white flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-200">
                <i class="fas fa-clock text-lg"></i>
            </div>
            <h3 class="font-bold text-gray-800 mb-2">{{ __('messages.dept_duration_label') }}</h3>
            <p class="text-light-blue font-semibold text-sm leading-relaxed">
                {{ __('messages.' . $deptDuration) }}
            </p>
        </div>

        {{-- Card 2: Requirements --}}
        <div class="bg-green-50 border border-green-100 rounded-2xl p-6 text-center hover:shadow-md transition group">
            <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-200">
                <i class="fas fa-graduation-cap text-lg"></i>
            </div>
            <h3 class="font-bold text-gray-800 mb-2">{{ __('messages.dept_requirements_label') }}</h3>
            <p class="text-green-700 font-semibold text-sm leading-relaxed">
                {{ __('messages.' . $deptReq) }}
            </p>
        </div>

        {{-- Card 3: Certification --}}
        <div class="bg-purple-50 border border-purple-100 rounded-2xl p-6 text-center hover:shadow-md transition group">
            <div class="w-12 h-12 rounded-full bg-purple-500 text-white flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-200">
                <i class="fas fa-certificate text-lg"></i>
            </div>
            <h3 class="font-bold text-gray-800 mb-2">{{ __('messages.dept_certification_label') }}</h3>
            <p class="text-purple-700 font-semibold text-sm leading-relaxed">
                {{ __('messages.' . $deptCert) }}
            </p>
        </div>

    </div>

    {{-- ── Career Opportunities Checklist ──────────────────────────────────── --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8 mb-10">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-briefcase text-light-blue"></i>
            {{ __('messages.dept_careers_label') }}
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach(__('messages.dept_' . $deptKey . '_careers') as $career)
            <div class="flex items-start gap-3 bg-gray-50 rounded-xl px-4 py-3 hover:bg-green-50 hover:border-green-200 border border-transparent transition">
                <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0 text-lg"></i>
                <span class="text-gray-700 font-medium text-sm">{{ $career }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ── Bottom CTA ───────────────────────────────────────────────────────── --}}
    <div class="bg-gradient-to-r {{ $deptColor }} to-gray-800 rounded-2xl p-8 text-center shadow-xl">
        <h3 class="text-white text-2xl font-bold mb-2">
            {{ __('messages.cta_heading') }}
        </h3>
        <p class="text-white/70 mb-6 text-base">
            {{ __('messages.cta_subtext') }}
        </p>
        <a href="{{ route('apply.start') }}"
           class="inline-flex items-center gap-2 bg-white text-gray-900 font-bold px-10 py-4 rounded-xl hover:bg-yellow-300 transition shadow-lg hover:shadow-xl text-lg">
            <i class="fas fa-file-alt"></i>
            {{ __('messages.apply_now') }}
        </a>
    </div>

</div>
