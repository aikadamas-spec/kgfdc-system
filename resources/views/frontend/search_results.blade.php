@extends('layouts.frontend')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Search form (repeat at top of results page) --}}
    <form action="{{ route('frontend.search') }}" method="GET" class="mb-10">
        <div class="flex gap-3">
            <input type="text"
                   name="query"
                   value="{{ $query }}"
                   placeholder="{{ __('messages.search_placeholder') }}"
                   autofocus
                   class="flex-1 px-5 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-light-blue text-gray-800 text-lg">
            <button type="submit"
                    class="bg-light-blue hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold transition">
                <i class="fas fa-search mr-2"></i>{{ __('messages.search') }}
            </button>
        </div>
    </form>

    {{-- Results header --}}
    @if($query !== '')
        <p class="text-gray-500 mb-6 text-sm">
            @if(count($results) > 0)
                <span class="font-semibold text-gray-700">{{ count($results) }}</span>
                {{ app()->getLocale() === 'sw' ? 'matokeo yamepatikana kwa' : 'result(s) found for' }}
                "<span class="font-semibold text-light-blue">{{ $query }}</span>"
            @else
                {{ app()->getLocale() === 'sw' ? 'Hakuna matokeo kwa' : 'No results for' }}
                "<span class="font-semibold text-light-blue">{{ $query }}</span>"
            @endif
        </p>
    @endif

    {{-- Results list --}}
    @if(count($results) > 0)
        <div class="space-y-4">
            @foreach($results as $item)
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-4 bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-light-blue transition group">

                    {{-- Icon --}}
                    <div class="w-12 h-12 rounded-full bg-light-blue/10 flex items-center justify-center flex-shrink-0 group-hover:bg-light-blue group-hover:text-white transition">
                        <i class="fas {{ $item['icon'] }} text-light-blue group-hover:text-white text-lg transition"></i>
                    </div>

                    {{-- Text --}}
                    <div class="flex-1 min-w-0">
                        {{-- Show the name in the current locale --}}
                        <p class="font-bold text-gray-800 group-hover:text-light-blue transition">
                            {{ app()->getLocale() === 'sw' ? $item['sw'] : $item['en'] }}
                        </p>
                        {{-- Show the other language as a subtitle --}}
                        <p class="text-sm text-gray-400 truncate">
                            {{ app()->getLocale() === 'sw' ? $item['en'] : $item['sw'] }}
                        </p>
                    </div>

                    {{-- Type badge --}}
                    <span class="text-xs font-semibold px-3 py-1 rounded-full flex-shrink-0
                        {{ $item['type'] === 'course'
                            ? 'bg-emerald-100 text-emerald-700'
                            : 'bg-blue-100 text-blue-700' }}">
                        {{ $item['type'] === 'course'
                            ? (app()->getLocale() === 'sw' ? 'Kozi' : 'Course')
                            : (app()->getLocale() === 'sw' ? 'Ukurasa' : 'Page') }}
                    </span>

                    <i class="fas fa-arrow-right text-gray-300 group-hover:text-light-blue transition flex-shrink-0"></i>
                </a>
            @endforeach
        </div>

    @elseif($query !== '')
        {{-- Empty state --}}
        <div class="text-center py-16">
            <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-search text-3xl text-gray-300"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-600 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Hakuna matokeo' : 'No results found' }}
            </h3>
            <p class="text-gray-400 mb-6">
                {{ app()->getLocale() === 'sw'
                    ? 'Jaribu maneno mengine au angalia orodha ya kozi zetu.'
                    : 'Try different keywords or browse our course list.' }}
            </p>
            <a href="{{ route('frontend.kozi-mrefu') }}"
               class="inline-flex items-center gap-2 bg-light-blue hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl transition">
                <i class="fas fa-list"></i>
                {{ __('messages.long_courses') }}
            </a>
        </div>

    @else
        {{-- No query yet — show popular links --}}
        <div>
            <p class="text-gray-500 mb-4 font-medium">
                {{ app()->getLocale() === 'sw' ? 'Maarufu:' : 'Popular:' }}
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('frontend.historia') }}"   class="bg-gray-100 hover:bg-light-blue hover:text-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium transition">{{ __('messages.history') }}</a>
                <a href="{{ route('frontend.kozi-mrefu') }}" class="bg-gray-100 hover:bg-light-blue hover:text-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium transition">{{ __('messages.long_courses') }}</a>
                <a href="{{ route('frontend.kozi-mfupi') }}" class="bg-gray-100 hover:bg-light-blue hover:text-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium transition">{{ __('messages.short_courses') }}</a>
                <a href="{{ route('frontend.hatua') }}"      class="bg-gray-100 hover:bg-light-blue hover:text-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium transition">{{ __('messages.join_us') }}</a>
                <a href="{{ route('apply.start') }}"         class="bg-gray-100 hover:bg-light-blue hover:text-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium transition">{{ __('messages.apply_now') }}</a>
            </div>
        </div>
    @endif

</div>

@endsection
