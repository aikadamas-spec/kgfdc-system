@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- ── Page Header ──────────────────────────────────────────────────────── --}}
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-3">
            {{ __('messages.sports_title') }}
        </h2>
        <span class="inline-block bg-light-blue/10 text-light-blue font-semibold text-sm px-4 py-1.5 rounded-full border border-light-blue/20 mb-4">
            {{ __('messages.sports_subtitle') }}
        </span>
        <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto text-justify">
            {{ __('messages.sports_intro') }}
        </p>
    </div>

    {{-- ── Sport Cards ──────────────────────────────────────────────────────── --}}
    @php
        $sports = [
            ['icon' => 'fa-futbol',          'color' => 'bg-green-50 text-green-500',  'title' => 'sports_football_title',  'text' => 'sports_football_text'],
            ['icon' => 'fa-basketball-ball', 'color' => 'bg-orange-50 text-orange-400','title' => 'sports_netball_title',   'text' => 'sports_netball_text'],
            ['icon' => 'fa-chess',           'color' => 'bg-purple-50 text-purple-500','title' => 'sports_games_title',     'text' => 'sports_games_text'],
            ['icon' => 'fa-running',         'color' => 'bg-red-50 text-red-400',      'title' => 'sports_athletics_title', 'text' => 'sports_athletics_text'],
            ['icon' => 'fa-volleyball-ball', 'color' => 'bg-blue-50 text-blue-500',    'title' => 'sports_volleyball_title','text' => 'sports_volleyball_text'],
            ['icon' => 'fa-music',           'color' => 'bg-yellow-50 text-yellow-500','title' => 'sports_culture_title',   'text' => 'sports_culture_text'],
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach($sports as $sport)
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 hover:shadow-md hover:border-light-blue/30 transition group">
            <div class="w-14 h-14 rounded-2xl {{ $sport['color'] }} flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-200">
                <i class="fas {{ $sport['icon'] }} text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">
                {{ __('messages.' . $sport['title']) }}
            </h3>
            <p class="text-gray-500 leading-relaxed text-sm text-justify">
                {{ __('messages.' . $sport['text']) }}
            </p>
        </div>
        @endforeach
    </div>

    {{-- Coming-soon notice --}}
    <p class="text-center text-gray-400 italic text-sm mb-10">
        {{ __('messages.sports_coming_soon') }}
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
