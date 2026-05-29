@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    <h2 class="text-4xl font-bold text-center mb-8">
        {{ __('messages.history_page_title') }}
    </h2>

    <p class="text-xl text-gray-500 text-justify leading-relaxed mb-6">
        {{ __('messages.history_p1') }}
    </p>

    <p class="text-xl text-gray-500 text-justify leading-relaxed mb-6">
        {{ __('messages.history_p2') }}
    </p>

    <p class="text-xl text-gray-500 text-justify leading-relaxed mb-6">
        {{ __('messages.history_p3') }}
    </p>

    <p class="text-xl text-gray-500 text-justify leading-relaxed mb-6">
        {{ __('messages.history_p4') }}
    </p>

    <p class="text-xl text-gray-500 text-justify leading-relaxed mb-6">
        {{ __('messages.history_p5') }}
    </p>

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
