@extends('layouts.frontend')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- ── Page Header ──────────────────────────────────────────────────────── --}}
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-3">
            {{ __('messages.timetable_title') }}
        </h2>
        <span class="inline-block bg-light-blue/10 text-light-blue font-semibold text-sm px-4 py-1.5 rounded-full border border-light-blue/20 mb-4">
            {{ __('messages.timetable_subtitle') }}
        </span>
        <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto text-justify">
            {{ __('messages.timetable_intro') }}
        </p>
    </div>

    {{-- ── Summary Cards ────────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10">
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 text-center">
            <div class="w-12 h-12 rounded-full bg-light-blue text-white flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-sun text-lg"></i>
            </div>
            <p class="font-bold text-gray-800">{{ __('messages.timetable_morning') }}</p>
            <p class="text-light-blue font-semibold text-sm mt-1">07:00 – 12:05</p>
        </div>
        <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5 text-center">
            <div class="w-12 h-12 rounded-full bg-orange-400 text-white flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-cloud-sun text-lg"></i>
            </div>
            <p class="font-bold text-gray-800">{{ __('messages.timetable_afternoon') }}</p>
            <p class="text-orange-500 font-semibold text-sm mt-1">12:35 – 16:30</p>
        </div>
        <div class="bg-green-50 border border-green-100 rounded-2xl p-5 text-center">
            <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-futbol text-lg"></i>
            </div>
            <p class="font-bold text-gray-800">{{ __('messages.timetable_practical') }}</p>
            <p class="text-green-600 font-semibold text-sm mt-1">Mon – Fri</p>
        </div>
    </div>

    {{-- ── Schedule Table ───────────────────────────────────────────────────── --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden mb-8">
        <div class="bg-light-blue px-6 py-4">
            <h3 class="text-white font-bold text-lg flex items-center gap-2">
                <i class="fas fa-calendar-alt"></i>
                {{ __('messages.timetable_class_hours') }}
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600 w-1/4">{{ __('messages.tt_time') }}</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600 w-1/2">{{ __('messages.tt_activity') }}</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600 w-1/4">{{ __('messages.tt_days') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @php
                        $rows = [
                            ['row' => 'tt_row1',  'type' => 'cleaning'],
                            ['row' => 'tt_row2',  'type' => 'assembly'],
                            ['row' => 'tt_row3',  'type' => 'theory'],
                            ['row' => 'tt_row4',  'type' => 'theory'],
                            ['row' => 'tt_row5',  'type' => 'break'],
                            ['row' => 'tt_row6',  'type' => 'theory'],
                            ['row' => 'tt_row7',  'type' => 'theory'],
                            ['row' => 'tt_row8',  'type' => 'lunch'],
                            ['row' => 'tt_row9',  'type' => 'theory'],
                            ['row' => 'tt_row10', 'type' => 'theory'],
                            ['row' => 'tt_row11', 'type' => 'sports'],
                            ['row' => 'tt_row12', 'type' => 'cleaning'],
                        ];
                        $badges = [
                            'cleaning'  => 'bg-yellow-100 text-yellow-700',
                            'assembly'  => 'bg-blue-100 text-blue-700',
                            'theory'    => 'bg-light-blue/10 text-light-blue',
                            'break'     => 'bg-gray-100 text-gray-500',
                            'lunch'     => 'bg-orange-100 text-orange-600',
                            'sports'    => 'bg-green-100 text-green-700',
                        ];
                    @endphp
                    @foreach($rows as $r)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-mono font-semibold text-gray-700 whitespace-nowrap">
                            {{ __('messages.' . $r['row'] . '_time') }}
                        </td>
                        <td class="px-6 py-4 text-justify">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $badges[$r['type']] }}">
                                {{ __('messages.' . $r['row'] . '_activity') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ __('messages.' . $r['row'] . '_days') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Badge Legend ─────────────────────────────────────────────────────── --}}
    <div class="flex flex-wrap gap-3 mb-8 justify-center text-xs font-semibold">
        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">🧹 {{ app()->getLocale() === 'sw' ? 'Usafi' : 'Cleaning' }}</span>
        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">🎺 {{ app()->getLocale() === 'sw' ? 'Parade' : 'Assembly' }}</span>
        <span class="px-3 py-1 rounded-full bg-light-blue/10 text-light-blue">📚 {{ app()->getLocale() === 'sw' ? 'Nadharia / Amali' : 'Theory / Practical' }}</span>
        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-500">☕ {{ app()->getLocale() === 'sw' ? 'Mapumziko ya Chai' : 'Tea Break' }}</span>
        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-600">🍽️ {{ app()->getLocale() === 'sw' ? 'Chakula cha Mchana' : 'Lunch Break' }}</span>
        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">⚽ {{ app()->getLocale() === 'sw' ? 'Michezo' : 'Sports' }}</span>
    </div>

    {{-- ── Note Box ─────────────────────────────────────────────────────────── --}}
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex gap-4 items-start mb-10">
        <div class="w-9 h-9 rounded-full bg-amber-400 text-white flex items-center justify-center flex-shrink-0 mt-0.5">
            <i class="fas fa-info text-sm"></i>
        </div>
        <div>
            <p class="font-bold text-amber-800 mb-1">{{ __('messages.timetable_note') }}</p>
            <p class="text-amber-700 text-sm text-justify leading-relaxed">
                {{ __('messages.timetable_note_text') }}
            </p>
        </div>
    </div>

    {{-- Coming-soon notice --}}
    <p class="text-center text-gray-400 italic text-sm mb-10">
        {{ __('messages.timetable_coming_soon') }}
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
