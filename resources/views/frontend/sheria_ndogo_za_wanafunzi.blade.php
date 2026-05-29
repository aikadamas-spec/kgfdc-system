@extends('layouts.frontend')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- ── Page Header ──────────────────────────────────────────────────────── --}}
    <div class="text-center mb-10">
        <h2 class="text-4xl font-bold mb-3">
            {{ __('messages.bylaws_title') }}
        </h2>
        <span class="inline-block bg-light-blue/10 text-light-blue font-semibold text-sm px-4 py-1.5 rounded-full border border-light-blue/20 mb-4">
            {{ __('messages.bylaws_subtitle') }}
        </span>
        <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto">
            {{ __('messages.bylaws_intro') }}
        </p>
    </div>

    {{-- ── Accordion Rules ──────────────────────────────────────────────────── --}}
    {{--
        Pure CSS accordion — no JavaScript required.
        Each rule uses a hidden checkbox + label trick for toggle behaviour.
        Works in all browsers and degrades gracefully.
    --}}

    @php
        $rules = [
            ['icon' => 'fa-tshirt',        'num' => '01', 'title' => 'bylaws_rule1_title', 'text' => 'bylaws_rule1_text'],
            ['icon' => 'fa-calendar-check','num' => '02', 'title' => 'bylaws_rule2_title', 'text' => 'bylaws_rule2_text'],
            ['icon' => 'fa-gavel',         'num' => '03', 'title' => 'bylaws_rule3_title', 'text' => 'bylaws_rule3_text'],
            ['icon' => 'fa-tools',         'num' => '04', 'title' => 'bylaws_rule4_title', 'text' => 'bylaws_rule4_text'],
            ['icon' => 'fa-mobile-alt',    'num' => '05', 'title' => 'bylaws_rule5_title', 'text' => 'bylaws_rule5_text'],
            ['icon' => 'fa-hard-hat',      'num' => '06', 'title' => 'bylaws_rule6_title', 'text' => 'bylaws_rule6_text'],
        ];
    @endphp

    <div class="space-y-3 mb-10">
        @foreach($rules as $i => $rule)
        <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }"
             class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

            {{-- Accordion header --}}
            <button @click="open = !open"
                    class="w-full flex items-center gap-4 px-6 py-5 text-left hover:bg-gray-50 transition focus:outline-none"
                    :aria-expanded="open">
                <span class="w-10 h-10 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center flex-shrink-0">
                    <i class="fas {{ $rule['icon'] }} text-sm"></i>
                </span>
                <span class="flex-1 font-bold text-gray-800 text-lg">
                    <span class="text-light-blue mr-2 text-sm font-semibold">{{ $rule['num'] }}</span>
                    {{ __('messages.' . $rule['title']) }}
                </span>
                <i class="fas fa-chevron-down text-gray-400 text-sm transition-transform duration-200"
                   :class="open ? 'rotate-180' : ''"></i>
            </button>

            {{-- Accordion body --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-1"
                 class="px-6 pb-6 pt-0">
                <div class="pl-14 text-gray-600 leading-relaxed border-t border-gray-50 pt-4">
                    {{ __('messages.' . $rule['text']) }}
                </div>
            </div>

        </div>
        @endforeach
    </div>

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
