@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    <h2 class="text-4xl font-bold text-center mb-4">
        {{ __('messages.short_courses_page_title') }}
    </h2>

    <p class="text-xl text-gray-500 text-justify leading-relaxed mb-10">
        {{ __('messages.short_courses_intro') }}
    </p>

    {{-- Entry Qualifications --}}
    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 mb-10">
        <h3 class="text-xl font-bold text-gray-700 mb-3 flex items-center gap-2">
            <i class="fas fa-graduation-cap text-light-blue"></i>
            {{ __('messages.short_courses_qualifications_title') }}
        </h3>
        <p class="text-gray-600 leading-relaxed">
            {{ __('messages.short_courses_qualifications') }}
        </p>
    </div>

    {{-- Course List --}}
    <h3 class="text-2xl font-bold text-gray-700 mb-6">
        {{ __('messages.short_courses_list_title') }}
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
        @foreach(__('messages.short_courses_list') as $course)
        <div class="flex items-center gap-3 bg-gray-50 border border-gray-100 rounded-xl p-4 hover:border-light-blue hover:bg-light-blue/5 transition">
            <span class="w-8 h-8 rounded-full bg-light-blue text-white flex items-center justify-center flex-shrink-0">
                <i class="fas {{ $course['icon'] }} text-xs"></i>
            </span>
            <span class="font-semibold text-gray-700">{{ $course['label'] }}</span>
        </div>
        @endforeach
    </div>

    {{-- Apply CTA --}}
    <div class="bg-gradient-to-r from-light-blue/5 to-blue-50 rounded-2xl border border-light-blue/20 p-8 text-center">
        <p class="text-gray-600 mb-5 text-lg">
            {{ __('messages.short_courses_cta') }}
        </p>
        <a href="{{ route('apply.start') }}"
           class="inline-flex items-center gap-2 bg-light-blue hover:bg-blue-600 text-white font-bold px-8 py-4 rounded-xl transition shadow-lg hover:shadow-xl text-lg">
            <i class="fas fa-file-alt"></i>
            {{ __('messages.apply_now') }}
        </a>
    </div>

</div>

@endsection
