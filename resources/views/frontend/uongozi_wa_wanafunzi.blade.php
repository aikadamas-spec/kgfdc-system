@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- ── Page Header ──────────────────────────────────────────────────────── --}}
    <div class="text-center mb-10">
        <h2 class="text-4xl font-bold mb-3">
            {{ __('messages.leadership_title') }}
        </h2>
        <span class="inline-block bg-light-blue/10 text-light-blue font-semibold text-sm px-4 py-1.5 rounded-full border border-light-blue/20 mb-4">
            {{ __('messages.leadership_subtitle') }}
        </span>
        <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto">
            {{ __('messages.leadership_text') }}
        </p>
    </div>

    {{-- ── Leadership Role Cards ────────────────────────────────────────────── --}}
    {{--
        When student leader records are available from the database, replace the
        role cards below with a @foreach loop over $leaders, using
        __('messages.leader_' . $leader->role_key) to translate each title.
    --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">

        {{-- President --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:border-light-blue/40 hover:shadow-md transition">
            <div class="w-16 h-16 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-tie text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg">—</h3>
            <p class="text-light-blue font-semibold text-sm mt-1">{{ __('messages.leader_president') }}</p>
        </div>

        {{-- Vice President --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:border-light-blue/40 hover:shadow-md transition">
            <div class="w-16 h-16 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-tie text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg">—</h3>
            <p class="text-light-blue font-semibold text-sm mt-1">{{ __('messages.leader_vp') }}</p>
        </div>

        {{-- General Secretary --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:border-light-blue/40 hover:shadow-md transition">
            <div class="w-16 h-16 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-pen-nib text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg">—</h3>
            <p class="text-light-blue font-semibold text-sm mt-1">{{ __('messages.leader_secretary') }}</p>
        </div>

        {{-- Treasurer --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:border-light-blue/40 hover:shadow-md transition">
            <div class="w-16 h-16 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-coins text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg">—</h3>
            <p class="text-light-blue font-semibold text-sm mt-1">{{ __('messages.leader_treasurer') }}</p>
        </div>

        {{-- Welfare Officer --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:border-light-blue/40 hover:shadow-md transition">
            <div class="w-16 h-16 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-hands-helping text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg">—</h3>
            <p class="text-light-blue font-semibold text-sm mt-1">{{ __('messages.leader_welfare') }}</p>
        </div>

        {{-- Sports Officer --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:border-light-blue/40 hover:shadow-md transition">
            <div class="w-16 h-16 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-futbol text-2xl"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg">—</h3>
            <p class="text-light-blue font-semibold text-sm mt-1">{{ __('messages.leader_sports') }}</p>
        </div>

    </div>

    {{-- Coming-soon notice --}}
    <p class="text-center text-gray-400 italic text-sm mb-10">
        {{ __('messages.leadership_coming_soon') }}
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
