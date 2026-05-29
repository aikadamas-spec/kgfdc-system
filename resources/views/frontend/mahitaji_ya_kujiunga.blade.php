@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    <h2 class="text-4xl font-bold text-center mb-4">
        {{ __('messages.req_title') }}
    </h2>
    <p class="text-xl text-center text-gray-500 leading-relaxed mb-10">
        {{ __('messages.req_subtitle') }}
    </p>

    {{-- ── Long-Term Courses ──────────────────────────────────────────────── --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8 mb-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
            <span class="w-10 h-10 rounded-full bg-light-blue text-white flex items-center justify-center flex-shrink-0">
                <i class="fas fa-graduation-cap text-sm"></i>
            </span>
            {{ __('messages.req_long_title') }}
        </h3>
        <ul class="space-y-4">
            <li class="flex items-start gap-3 text-gray-700 text-lg">
                <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                {{ __('messages.req_item1') }}
            </li>
            <li class="flex items-start gap-3 text-gray-700 text-lg">
                <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                {{ __('messages.req_item2') }}
            </li>
            <li class="flex items-start gap-3 text-gray-700 text-lg">
                <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                {{ __('messages.req_item3') }}
            </li>
            <li class="flex items-start gap-3 text-gray-700 text-lg">
                <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                {{ __('messages.req_item4') }}
            </li>
        </ul>
    </div>

    {{-- ── Short-Term Courses ─────────────────────────────────────────────── --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8 mb-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
            <span class="w-10 h-10 rounded-full bg-light-blue text-white flex items-center justify-center flex-shrink-0">
                <i class="fas fa-clock text-sm"></i>
            </span>
            {{ __('messages.req_short_title') }}
        </h3>
        <ul class="space-y-4">
            <li class="flex items-start gap-3 text-gray-700 text-lg">
                <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                {{ __('messages.req_short_item1') }}
            </li>
            <li class="flex items-start gap-3 text-gray-700 text-lg">
                <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                {{ __('messages.req_short_item2') }}
            </li>
            <li class="flex items-start gap-3 text-gray-700 text-lg">
                <i class="fas fa-check-circle text-light-blue mt-1 flex-shrink-0"></i>
                {{ __('messages.req_short_item3') }}
            </li>
        </ul>
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
