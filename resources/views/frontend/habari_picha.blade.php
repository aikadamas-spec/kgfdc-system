@extends('layouts.frontend')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- ── Page Header ──────────────────────────────────────────────────────── --}}
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-3">
            {{ __('messages.gallery_title') }}
        </h2>
        <span class="inline-block bg-light-blue/10 text-light-blue font-semibold text-sm px-4 py-1.5 rounded-full border border-light-blue/20 mb-4">
            {{ __('messages.gallery_subtitle') }}
        </span>
        <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto text-justify">
            {{ __('messages.gallery_intro') }}
        </p>
    </div>

    {{-- ── News Cards (top 3 from homepage, now with full text) ───────────────── --}}
    <div class="grid md:grid-cols-3 gap-6 mb-14">

        {{-- News 1 — Mechanic Workshop --}}
        <article class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden hover:shadow-md hover:border-light-blue/30 transition group">
            <div class="overflow-hidden h-48">
                <img src="{{ asset('frontend_assets/img/autogarage.webp') }}"
                     alt="{{ __('messages.news1_title') }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="p-5">
                <span class="text-xs text-light-blue font-semibold uppercase tracking-wide">{{ __('messages.gallery_news') }}</span>
                <h3 class="font-bold text-gray-800 text-base mt-1 mb-2 group-hover:text-light-blue transition">
                    {{ __('messages.news1_title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed text-justify">
                    {{ __('messages.news1_body') }}
                </p>
            </div>
        </article>

        {{-- News 2 — Plumbing Workshop --}}
        <article class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden hover:shadow-md hover:border-light-blue/30 transition group">
            <div class="overflow-hidden h-48">
                <img src="{{ asset('frontend_assets/img/bomba.webp') }}"
                     alt="{{ __('messages.news2_title') }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="p-5">
                <span class="text-xs text-light-blue font-semibold uppercase tracking-wide">{{ __('messages.gallery_news') }}</span>
                <h3 class="font-bold text-gray-800 text-base mt-1 mb-2 group-hover:text-light-blue transition">
                    {{ __('messages.news2_title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed text-justify">
                    {{ __('messages.news2_body') }}
                </p>
            </div>
        </article>

        {{-- News 3 — Electrical Workshop --}}
        <article class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden hover:shadow-md hover:border-light-blue/30 transition group">
            <div class="overflow-hidden h-48">
                <img src="{{ asset('frontend_assets/img/umememajumbani2.webp') }}"
                     alt="{{ __('messages.news3_title') }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="p-5">
                <span class="text-xs text-light-blue font-semibold uppercase tracking-wide">{{ __('messages.gallery_news') }}</span>
                <h3 class="font-bold text-gray-800 text-base mt-1 mb-2 group-hover:text-light-blue transition">
                    {{ __('messages.news3_title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed text-justify">
                    {{ __('messages.news3_body') }}
                </p>
            </div>
        </article>

    </div>

    {{-- ── Photo Gallery Grid ───────────────────────────────────────────────── --}}
    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        <i class="fas fa-images text-light-blue"></i>
        {{ __('messages.gallery_campus') }}
    </h3>

    @php
        $photos = [
            ['src' => 'ufundimagari.webp',    'alt' => 'dept_mechanic'],
            ['src' => 'umememagari.webp',      'alt' => 'dept_auto_electrical'],
            ['src' => 'umememajumbani.webp',   'alt' => 'dept_domestic_elec'],
            ['src' => 'uchomeleaji.webp',      'alt' => 'dept_welding'],
            ['src' => 'ufundibomba.webp',      'alt' => 'dept_plumbing'],
            ['src' => 'ushonaji.webp',         'alt' => 'dept_tailoring'],
            ['src' => 'uashi.webp',            'alt' => 'dept_masonry'],
            ['src' => 'ict.webp',              'alt' => 'dept_ict'],
            ['src' => 'shortcourse.webp',      'alt' => 'short_courses'],
            ['src' => 'ziara1.webp',           'alt' => 'gallery_events'],
            ['src' => 'ziara2.webp',           'alt' => 'gallery_events'],
            ['src' => 'kgfdc.webp',            'alt' => 'gallery_campus'],
        ];
    @endphp

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-10">
        @foreach($photos as $photo)
        <div class="relative group overflow-hidden rounded-2xl aspect-square bg-gray-100 shadow-sm">
            <img src="{{ asset('frontend_assets/img/' . $photo['src']) }}"
                 alt="{{ __('messages.' . $photo['alt']) }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            {{-- Hover overlay --}}
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                <span class="text-white text-xs font-semibold flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-full border border-white/30">
                    <i class="fas fa-search-plus text-xs"></i>
                    {{ __('messages.view_image') }}
                </span>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Coming-soon notice --}}
    <p class="text-center text-gray-400 italic text-sm mb-10">
        {{ __('messages.gallery_coming_soon') }}
    </p>

    {{-- ── CTA ──────────────────────────────────────────────────────────────── --}}
    <div class="bg-gradient-to-r from-light-blue/5 to-blue-50 rounded-2xl border border-light-blue/20 p-8 text-center">
        <p class="text-gray-600 mb-5 text-lg">
            {{ __('messages.cta_heading') }}
        </p>
        <a href="{{ route('apply.start') }}"
           class="inline-flex items-center gap-2 bg-light-blue hover:bg-blue-600 text-white font-bold px-8 py-4 rounded-xl transition shadow-lg hover:shadow-xl text-lg">
            <i class="fas fa-file-alt"></i>
            {{ __('messages.apply_now') }}
        </a>
    </div>

</div>

@endsection
