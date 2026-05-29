@extends('layouts.frontend')

@section('content')

{{-- Page heading --}}
<h2 class="text-4xl font-bold text-center mb-3">
    {{ __('messages.gov_title') }}
</h2>

{{-- Introductory subtitle --}}
<p class="text-xl text-gray-500 text-center leading-relaxed mb-6">
    {{ __('messages.gov_subtitle') }}
</p>

{{-- Organisational chart PDF — responsive iframe viewer --}}
<div style="display:flex !important; justify-content:center !important; margin-top:25px !important; margin-bottom:25px !important; width:100% !important;">
    <iframe src="{{ asset('images/muundo-wa-taasisi.pdf') }}"
            style="width:100% !important; height:600px !important; border:1px solid #cbd5e1 !important; border-radius:8px !important; box-shadow:0 4px 15px rgba(0,0,0,0.1) !important;"
            frameborder="0">
    </iframe>
</div>

@endsection
