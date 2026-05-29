@extends('layouts.frontend')

@section('content')

{{-- Page heading --}}
<h2 class="text-4xl font-bold text-center mb-3">
    {{ __('messages.staff') }}
</h2>

<p class="text-xl text-gray-500 text-center leading-relaxed mb-6">
    {{ app()->getLocale() === 'sw'
        ? 'Muundo wa kamati za usimamizi wa Kigamboni FDC upo kama ifuatavyo:'
        : 'The committee structure of Kigamboni FDC is as follows:' }}
</p>

{{-- Kamati za Chuo PDF viewer --}}
<div style="display:flex !important; justify-content:center !important; margin-top:25px !important; margin-bottom:25px !important; width:100% !important;">
    <iframe src="{{ asset('images/kamati-za-chuo.pdf') }}"
            style="width:100% !important; height:650px !important; border:1px solid #cbd5e1 !important; border-radius:8px !important; box-shadow:0 4px 15px rgba(0,0,0,0.1) !important;"
            frameborder="0">
        <p class="text-gray-500 p-4">
            {{ app()->getLocale() === 'sw' ? 'Kivinjari chako hakisaidii PDF.' : 'Your browser does not support PDF viewing.' }}
            <a href="{{ asset('images/kamati-za-chuo.pdf') }}" target="_blank" class="text-light-blue underline">
                {{ app()->getLocale() === 'sw' ? 'Pakua hapa.' : 'Download here.' }}
            </a>
        </p>
    </iframe>
</div>

@endsection
