@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Page heading --}}
    <h1 class="text-4xl font-bold text-center mb-12">
        {{ __('messages.goals_page_title') }}
    </h1>

    {{-- ── GOALS (LENGO) ─────────────────────────────────────────────────── --}}
    <div class="mb-12">
        <div class="text-center mb-6">
            <div class="w-16 h-16 rounded-full bg-light-blue/10 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-bullseye text-2xl text-light-blue"></i>
            </div>
            <h2 class="text-3xl font-bold">{{ __('messages.goals_title') }}</h2>
        </div>

        <div class="bg-gray-50 rounded-2xl border border-gray-100 p-6 space-y-4">
            <p class="text-xl text-gray-600 leading-relaxed text-justify">
                {{ __('messages.goals_p1') }}
            </p>
            <p class="text-xl text-gray-600 leading-relaxed text-justify">
                {{ __('messages.goals_p2') }}
            </p>
        </div>
    </div>

    <hr class="border-gray-200 mb-12">

    {{-- ── OBJECTIVES (MADHUMUNI) ─────────────────────────────────────────── --}}
    <div class="mb-12">
        <div class="text-center mb-6">
            <div class="w-16 h-16 rounded-full bg-light-blue/10 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-list-check text-2xl text-light-blue"></i>
            </div>
            <h2 class="text-3xl font-bold">{{ __('messages.objectives_title') }}</h2>
        </div>

        <div class="bg-gray-50 rounded-2xl border border-gray-100 p-6 space-y-4">
            <p class="text-xl text-gray-600 leading-relaxed">{{ __('messages.objective_1') }}</p>
            <p class="text-xl text-gray-600 leading-relaxed">{{ __('messages.objective_2') }}</p>
            <p class="text-xl text-gray-600 leading-relaxed">{{ __('messages.objective_3') }}</p>
            <p class="text-xl text-gray-600 leading-relaxed">{{ __('messages.objective_4') }}</p>
        </div>
    </div>

    <hr class="border-gray-200 mb-12">

    {{-- ── DUTIES (WAJIBU) ────────────────────────────────────────────────── --}}
    <div class="mb-12">
        <div class="text-center mb-6">
            <div class="w-16 h-16 rounded-full bg-light-blue/10 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-briefcase text-2xl text-light-blue"></i>
            </div>
            <h2 class="text-3xl font-bold">{{ __('messages.duties_title') }}</h2>
        </div>

        <div class="bg-gray-50 rounded-2xl border border-gray-100 p-6 space-y-4">
            <p class="text-xl text-gray-600 leading-relaxed">{{ __('messages.duty_1') }}</p>
            <p class="text-xl text-gray-600 leading-relaxed">{{ __('messages.duty_2') }}</p>
            <p class="text-xl text-gray-600 leading-relaxed">{{ __('messages.duty_3') }}</p>
            <p class="text-xl text-gray-600 leading-relaxed">{{ __('messages.duty_4') }}</p>
        </div>
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
