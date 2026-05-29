@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    <h2 class="text-4xl font-bold text-center mb-10">
        {{ __('messages.qualifications_title') }}
    </h2>

    {{-- ── Long-Term Courses ──────────────────────────────────────────────── --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8 mb-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-5 flex items-center gap-3">
            <span class="w-10 h-10 rounded-full bg-light-blue text-white flex items-center justify-center flex-shrink-0">
                <i class="fas fa-graduation-cap text-sm"></i>
            </span>
            {{ __('messages.qual_long_course_title') }}
        </h3>
        <ul class="space-y-3">
            <li class="flex items-start gap-3 text-gray-700 text-lg">
                <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                {{ __('messages.qual_long_age') }}
            </li>
            <li class="flex items-start gap-3 text-gray-700 text-lg">
                <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                {{ __('messages.qual_long_course_text') }}
            </li>
        </ul>
    </div>

    {{-- ── Short-Term Courses ─────────────────────────────────────────────── --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8 mb-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
            <span class="w-10 h-10 rounded-full bg-light-blue text-white flex items-center justify-center flex-shrink-0">
                <i class="fas fa-clock text-sm"></i>
            </span>
            {{ __('messages.qual_short_course_title') }}
        </h3>

        {{-- FE – Folk Education --}}
        <div class="mb-6 pl-4 border-l-4 border-light-blue/30">
            <p class="font-bold text-gray-800 text-lg mb-2">{{ __('messages.qual_fe_heading') }}</p>
            <p class="text-gray-600 mb-3">{{ __('messages.qual_fe_desc') }}</p>
            <ul class="space-y-2">
                <li class="flex items-start gap-3 text-gray-700">
                    <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                    {{ __('messages.qual_fe_age') }}
                </li>
                <li class="flex items-start gap-3 text-gray-700">
                    <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                    {{ __('messages.qual_fe_literacy') }}
                </li>
            </ul>
        </div>

        {{-- 6-Month Course --}}
        <div class="mb-6 pl-4 border-l-4 border-light-blue/30">
            <p class="font-bold text-gray-800 text-lg mb-2">{{ __('messages.qual_6month_heading') }}</p>
            <ul class="space-y-2">
                <li class="flex items-start gap-3 text-gray-700">
                    <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                    {{ __('messages.qual_6month_age') }}
                </li>
                <li class="flex items-start gap-3 text-gray-700">
                    <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                    {{ __('messages.qual_6month_literacy') }}
                </li>
                <li class="flex items-start gap-3 text-gray-700">
                    <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                    {{ __('messages.qual_short_course_text') }}
                </li>
            </ul>
        </div>

        {{-- Apprenticeship --}}
        <div class="pl-4 border-l-4 border-light-blue/30">
            <p class="font-bold text-gray-800 text-lg mb-2">{{ __('messages.qual_apprentice_heading') }}</p>
            <p class="text-gray-700">{{ __('messages.qual_apprentice_desc') }}</p>
        </div>
    </div>

    {{-- Apply CTA --}}
    <div class="bg-gradient-to-r from-light-blue/5 to-blue-50 rounded-2xl border border-light-blue/20 p-8 text-center">
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
