@extends('layouts.frontend')

@section('content')

{{-- ── Page Header ─────────────────────────────────────────────────────────── --}}
<div class="text-center mb-10">
    <h2 class="text-4xl font-bold mb-3">{{ __('messages.grad_title') }}</h2>
    <p class="text-xl text-gray-500 leading-relaxed">
        {{ __('messages.grad_subtitle') }}
    </p>
</div>

{{-- ── Section Labels ───────────────────────────────────────────────────────── --}}
<div class="container mx-auto px-4 py-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-2xl font-semibold mb-2">{{ __('messages.grad_success_stories') }}</h3>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-2xl font-semibold mb-2">{{ __('messages.grad_alumni_network') }}</h3>
        </div>
    </div>

    {{-- Coming-soon placeholder — replace with a @foreach loop over $graduates when data is available --}}
    <p class="text-center text-gray-400 italic">
        {{ __('messages.grad_coming_soon') }}
    </p>
</div>

@endsection
