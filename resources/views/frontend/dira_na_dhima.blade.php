@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- VISION --}}
    <div class="mb-12 text-center">
        <div class="w-16 h-16 rounded-full bg-light-blue/10 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-eye text-2xl text-light-blue"></i>
        </div>
        <h2 class="text-4xl font-bold mb-4">
            {{ __('messages.vision_page_title') }}
        </h2>
        <p class="text-xl text-gray-500 leading-relaxed max-w-2xl mx-auto">
            {{ __('messages.vision_content') }}
        </p>
    </div>

    <hr class="border-gray-200 mb-12">

    {{-- MISSION --}}
    <div class="mb-12 text-center">
        <div class="w-16 h-16 rounded-full bg-light-blue/10 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-bullseye text-2xl text-light-blue"></i>
        </div>
        <h2 class="text-4xl font-bold mb-4">
            {{ __('messages.mission_page_title') }}
        </h2>
        <p class="text-xl text-gray-500 leading-relaxed max-w-2xl mx-auto">
            {{ __('messages.mission_content') }}
        </p>
    </div>

    {{-- Apply CTA --}}
    <div class="mt-10 text-center">
        <a href="{{ route('apply.start') }}"
           class="inline-flex items-center gap-2 bg-light-blue hover:bg-blue-600 text-white font-bold px-8 py-4 rounded-xl transition shadow-lg hover:shadow-xl text-lg">
            <i class="fas fa-file-alt"></i>
            {{ __('messages.apply_now') }}
        </a>
    </div>

</div>

@endsection
