@extends('layouts.frontend')

@section('content')

<div class="max-w-2xl mx-auto text-center py-6">

    {{-- Icon --}}
    <div class="w-20 h-20 rounded-full bg-yellow-100 flex items-center justify-center mx-auto mb-6 shadow-inner">
        <i class="fas fa-mobile-alt text-4xl text-yellow-500"></i>
    </div>

    <h1 class="text-3xl font-bold text-gray-800 mb-3">Ombi Limepokelewa!</h1>
    <p class="text-gray-500 text-lg mb-8">
        Hatua inayofuata ni kukamilisha malipo ya ada ya fomu ya
        <strong class="text-light-blue">TSH 15,000</strong>
        kupitia simu yako ya mkononi.
    </p>

    {{-- Application Summary Card --}}
    <div class="bg-gray-50 rounded-2xl border border-gray-200 p-6 text-left mb-8 shadow-sm">
        <h2 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fas fa-receipt text-light-blue"></i>
            Muhtasari wa Ombi Lako
        </h2>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between py-2 border-b border-gray-100">
                <span class="text-gray-500">Namba ya Kumbukumbu</span>
                <span class="font-bold text-gray-800 font-mono tracking-wider">{{ $application->payment_reference }}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100">
                <span class="text-gray-500">Jina Kamili</span>
                <span class="font-semibold text-gray-800">{{ $application->full_name }}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100">
                <span class="text-gray-500">Namba ya Simu</span>
                <span class="font-semibold text-gray-800">{{ $application->phone_number }}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100">
                <span class="text-gray-500">Kozi Iliyochaguliwa</span>
                <span class="font-semibold text-gray-800">{{ $application->course_applied }}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100">
                <span class="text-gray-500">Aina ya Kozi</span>
                <span class="font-semibold text-gray-800">
                    {{ $application->course_type === 'mrefu' ? 'Muda Mrefu' : 'Muda Mfupi' }}
                </span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100">
                <span class="text-gray-500">Ada ya Fomu</span>
                <span class="font-bold text-gray-800">TSH 15,000</span>
            </div>
            <div class="flex justify-between py-2">
                <span class="text-gray-500">Hali ya Malipo</span>
                <span class="inline-flex items-center gap-1.5 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                    Inasubiri Malipo
                </span>
            </div>
        </div>
    </div>

    {{-- Payment Instructions --}}
    <div class="bg-blue-50 rounded-2xl border border-blue-100 p-6 text-left mb-8">
        <h2 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fas fa-list-ol text-light-blue"></i>
            Jinsi ya Kulipa (Beem Mobile Money)
        </h2>
        <ol class="space-y-3 text-sm text-gray-600">
            <li class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">1</span>
                <span>Bonyeza kitufe cha <strong>"Lipa Sasa"</strong> hapa chini ili kutuma ombi la malipo kwenye simu yako</span>
            </li>
            <li class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">2</span>
                <span>Subiri ujumbe wa <strong>USSD/SMS</strong> kutoka Beem kwenye namba yako <strong class="text-gray-800">{{ $application->phone_number }}</strong></span>
            </li>
            <li class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">3</span>
                <span>Ingiza <strong>PIN yako ya M-Pesa / Tigo Pesa / Airtel Money</strong> kuthibitisha malipo ya <strong class="text-light-blue">TSH 15,000</strong></span>
            </li>
            <li class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">4</span>
                <span>Baada ya malipo kukamilika, utapokea <strong>SMS ya uthibitisho</strong> na maelezo ya kuingia kwenye mfumo</span>
            </li>
        </ol>
    </div>

    {{-- Alert area (shown after AJAX response) --}}
    <div id="payAlert" class="hidden mb-6 rounded-xl p-4 text-sm font-medium"></div>

    {{-- Pay Now Button --}}
    <div class="mb-8">
        <button id="payBtn"
                onclick="initiatePayment()"
                class="w-full bg-light-blue hover:bg-blue-600 text-white font-bold py-4 px-8 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 text-lg">
            <i class="fas fa-mobile-alt"></i>
            Lipa Sasa — TSH 15,000
        </button>
        <p class="text-center text-xs text-gray-400 mt-2">
            <i class="fas fa-lock mr-1"></i>
            Malipo yanafanywa kwa usalama kupitia Beem Africa.
        </p>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('frontend.home') }}"
           class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-8 py-3 rounded-xl transition">
            <i class="fas fa-home"></i>
            Rudi Nyumbani
        </a>
        <a href="https://wa.me/255717685138?text=Habari%2C%20namba%20yangu%20ya%20kumbukumbu%20ni%3A%20{{ $application->payment_reference }}"
           target="_blank"
           class="inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-3 rounded-xl transition shadow-md hover:shadow-lg">
            <i class="fab fa-whatsapp"></i>
            Wasiliana Nasi (WhatsApp)
        </a>
    </div>

</div>

@endsection

@section('script')
<script>
function initiatePayment() {
    const btn = document.getElementById('payBtn');
    const alert = document.getElementById('payAlert');

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Inatuma ombi...';
    alert.className = 'hidden mb-6 rounded-xl p-4 text-sm font-medium';

    fetch('{{ route('apply.beem.initiate') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ reference: '{{ $application->payment_reference }}' })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert.className = 'mb-6 rounded-xl p-4 text-sm font-medium bg-green-50 border border-green-200 text-green-700';
            alert.innerHTML = '<i class="fas fa-check-circle mr-2"></i>' + data.message;
            btn.innerHTML = '<i class="fas fa-clock mr-2"></i> Inasubiri uthibitisho...';
        } else {
            alert.className = 'mb-6 rounded-xl p-4 text-sm font-medium bg-red-50 border border-red-200 text-red-700';
            alert.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i>' + data.message;
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-mobile-alt mr-2"></i> Jaribu Tena';
        }
    })
    .catch(() => {
        alert.className = 'mb-6 rounded-xl p-4 text-sm font-medium bg-red-50 border border-red-200 text-red-700';
        alert.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Hitilafu ya mtandao. Tafadhali jaribu tena.';
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-mobile-alt mr-2"></i> Jaribu Tena';
    });
}
</script>
@endsection
