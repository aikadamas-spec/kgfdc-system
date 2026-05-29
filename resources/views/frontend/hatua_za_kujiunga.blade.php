@extends('layouts.frontend')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- ── Page Header ──────────────────────────────────────────────────────── --}}
    <h2 class="text-4xl font-bold text-center mb-4">
        {{ __('messages.steps_title') }}
    </h2>
    <p class="text-xl text-center text-gray-500 leading-relaxed mb-12">
        {{ __('messages.steps_subtitle') }}
    </p>

    {{-- ── Vertical Timeline ────────────────────────────────────────────────── --}}
    <div class="relative">

        {{-- Vertical connector line --}}
        <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-light-blue/20 hidden md:block"></div>

        {{-- Step 1 --}}
        <div class="relative flex gap-6 mb-10">
            <div class="flex-shrink-0 w-16 h-16 rounded-full bg-light-blue text-white flex flex-col items-center justify-center shadow-lg z-10">
                <i class="fas fa-file-alt text-xl"></i>
                <span class="text-xs font-bold leading-none mt-0.5">01</span>
            </div>
            <div class="flex-1 bg-white border border-gray-100 rounded-2xl shadow-sm p-6 hover:border-light-blue/40 transition">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ __('messages.step1_title') }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('messages.step1_text') }}
                </p>
                <a href="{{ route('apply.start') }}"
                   class="inline-flex items-center gap-2 mt-4 text-light-blue font-semibold hover:underline text-sm">
                    {{ __('messages.apply_now') }}
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        {{-- Step 2 --}}
        <div class="relative flex gap-6 mb-10">
            <div class="flex-shrink-0 w-16 h-16 rounded-full bg-light-blue text-white flex flex-col items-center justify-center shadow-lg z-10">
                <i class="fas fa-mobile-alt text-xl"></i>
                <span class="text-xs font-bold leading-none mt-0.5">02</span>
            </div>
            <div class="flex-1 bg-white border border-gray-100 rounded-2xl shadow-sm p-6 hover:border-light-blue/40 transition">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ __('messages.step2_title') }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('messages.step2_text') }}
                </p>
                <span class="inline-block mt-4 bg-green-50 text-green-700 text-sm font-semibold px-3 py-1 rounded-full border border-green-200">
                    TZS 15,000
                </span>
            </div>
        </div>

        {{-- Step 3 --}}
        <div class="relative flex gap-6 mb-10">
            <div class="flex-shrink-0 w-16 h-16 rounded-full bg-light-blue text-white flex flex-col items-center justify-center shadow-lg z-10">
                <i class="fas fa-envelope-open-text text-xl"></i>
                <span class="text-xs font-bold leading-none mt-0.5">03</span>
            </div>
            <div class="flex-1 bg-white border border-gray-100 rounded-2xl shadow-sm p-6 hover:border-light-blue/40 transition">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ __('messages.step3_title') }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('messages.step3_text') }}
                </p>
            </div>
        </div>

        {{-- Step 4 --}}
        <div class="relative flex gap-6">
            <div class="flex-shrink-0 w-16 h-16 rounded-full bg-light-blue text-white flex flex-col items-center justify-center shadow-lg z-10">
                <i class="fas fa-school text-xl"></i>
                <span class="text-xs font-bold leading-none mt-0.5">04</span>
            </div>
            <div class="flex-1 bg-white border border-gray-100 rounded-2xl shadow-sm p-6 hover:border-light-blue/40 transition">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ __('messages.step4_title') }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('messages.step4_text') }}
                </p>
            </div>
        </div>

    </div>

    {{-- ── Apply CTA ─────────────────────────────────────────────────────────── --}}
    <div class="bg-gradient-to-r from-light-blue/5 to-blue-50 rounded-2xl border border-light-blue/20 p-8 text-center mt-12">
        <p class="text-gray-600 mb-5 text-lg">
            {{ __('messages.long_courses_cta') }}
        </p>
        <a href="{{ route('apply.start') }}"
           class="inline-flex items-center gap-2 bg-light-blue hover:bg-blue-600 text-white font-bold px-8 py-4 rounded-xl transition shadow-lg hover:shadow-xl text-lg">
            <i class="fas fa-file-alt"></i>
            {{ __('messages.apply_now') }}
        </a>
    </div>

</div>

@endsection
