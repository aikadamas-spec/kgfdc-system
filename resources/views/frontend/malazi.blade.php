@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- ── Page Header ──────────────────────────────────────────────────────── --}}
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-3">
            {{ __('messages.accommodation_title') }}
        </h2>
        <span class="inline-block bg-light-blue/10 text-light-blue font-semibold text-sm px-4 py-1.5 rounded-full border border-light-blue/20 mb-4">
            {{ __('messages.accommodation_subtitle') }}
        </span>
        <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto">
            {{ __('messages.accommodation_intro') }}
        </p>
    </div>

    {{-- ── Feature Cards ────────────────────────────────────────────────────── --}}
    @php
        $features = [
            ['icon' => 'fa-bed',          'color' => 'bg-blue-50 text-blue-500',   'title' => 'acc_feature1_title', 'text' => 'acc_feature1_text'],
            ['icon' => 'fa-shield-alt',   'color' => 'bg-green-50 text-green-500', 'title' => 'acc_feature2_title', 'text' => 'acc_feature2_text'],
            ['icon' => 'fa-faucet',       'color' => 'bg-cyan-50 text-cyan-500',   'title' => 'acc_feature3_title', 'text' => 'acc_feature3_text'],
            ['icon' => 'fa-heartbeat',    'color' => 'bg-red-50 text-red-400',     'title' => 'acc_feature4_title', 'text' => 'acc_feature4_text'],
            ['icon' => 'fa-utensils',     'color' => 'bg-orange-50 text-orange-400','title' => 'acc_feature5_title', 'text' => 'acc_feature5_text'],
            ['icon' => 'fa-book-open',    'color' => 'bg-purple-50 text-purple-500','title' => 'acc_feature6_title', 'text' => 'acc_feature6_text'],
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach($features as $feature)
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 hover:shadow-md hover:border-light-blue/30 transition group">
            <div class="w-14 h-14 rounded-2xl {{ $feature['color'] }} flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-200">
                <i class="fas {{ $feature['icon'] }} text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">
                {{ __('messages.' . $feature['title']) }}
            </h3>
            <p class="text-gray-500 leading-relaxed text-sm text-justify">
                {{ __('messages.' . $feature['text']) }}
            </p>
        </div>
        @endforeach
    </div>

    {{-- Coming-soon notice --}}
    <p class="text-center text-gray-400 italic text-sm mb-10">
        {{ __('messages.acc_coming_soon') }}
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
