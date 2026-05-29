@extends('layouts.frontend')

@section('content')

<div class="max-w-xl mx-auto text-center py-10">

    {{-- Success Icon --}}
    <div class="w-24 h-24 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-6 shadow-inner">
        <i class="fas fa-check-circle text-5xl text-green-500"></i>
    </div>

    <h1 class="text-3xl font-bold text-gray-800 mb-3">Malipo Yamekamilika!</h1>
    <p class="text-gray-500 text-lg mb-8">
        Hongera, <strong class="text-gray-700">{{ $application->full_name }}</strong>!
        Malipo yako ya <strong class="text-light-blue">TSH 15,000</strong> yamepokelewa na kuthibitishwa.
    </p>

    {{-- SMS Notice --}}
    <div class="bg-green-50 border border-green-200 rounded-2xl p-6 mb-8 text-left">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-sms text-2xl text-green-600"></i>
            </div>
            <div>
                <h2 class="font-bold text-green-800 text-lg mb-1">Angalia SMS Yako</h2>
                <p class="text-green-700 text-sm leading-relaxed">
                    Tumekutumia ujumbe wa SMS kwenye namba yako
                    <strong>{{ $application->phone_number }}</strong>
                    ukiwa na <strong>Email</strong> na <strong>Password</strong> ya kuingia kwenye mfumo wa Kg FDC.
                </p>
                <p class="text-green-600 text-xs mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Kama hujapokea SMS, wasiliana nasi kupitia WhatsApp hapa chini.
                </p>
            </div>
        </div>
    </div>

    {{-- Reference Card --}}
    <div class="bg-gray-50 rounded-2xl border border-gray-200 p-5 mb-8 text-left">
        <h3 class="font-bold text-gray-700 mb-3 text-sm uppercase tracking-wide">Muhtasari wa Ombi</h3>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between py-1.5 border-b border-gray-100">
                <span class="text-gray-500">Namba ya Kumbukumbu</span>
                <span class="font-bold font-mono text-gray-800 tracking-wider">{{ $application->payment_reference }}</span>
            </div>
            <div class="flex justify-between py-1.5 border-b border-gray-100">
                <span class="text-gray-500">Kozi</span>
                <span class="font-semibold text-gray-800">{{ $application->course_applied }}</span>
            </div>
            <div class="flex justify-between py-1.5 border-b border-gray-100">
                <span class="text-gray-500">Ada Iliyolipwa</span>
                <span class="font-bold text-green-600">TSH 15,000 ✓</span>
            </div>
            <div class="flex justify-between py-1.5">
                <span class="text-gray-500">Hali</span>
                <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                    <i class="fas fa-check text-xs"></i>
                    Amelipa
                </span>
            </div>
        </div>
    </div>

    {{-- Next Steps --}}
    <div class="bg-blue-50 rounded-2xl border border-blue-100 p-6 mb-8 text-left">
        <h3 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
            <i class="fas fa-tasks text-light-blue"></i>
            Hatua Zinazofuata
        </h3>
        <ol class="space-y-2 text-sm text-gray-600">
            <li class="flex items-start gap-2">
                <span class="w-5 h-5 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">1</span>
                <span>Ingia kwenye mfumo ukitumia <strong>Email</strong> na <strong>Password</strong> uliyopokea kwa SMS</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="w-5 h-5 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">2</span>
                <span>Kamilisha fomu yako ya maombi ndani ya mfumo</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="w-5 h-5 rounded-full bg-light-blue text-white text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">3</span>
                <span>Subiri majibu ya ombi lako kutoka kwa timu ya Kg FDC</span>
            </li>
        </ol>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('login') }}"
           class="inline-flex items-center justify-center gap-2 bg-light-blue hover:bg-blue-600 text-white font-semibold px-8 py-3 rounded-xl transition shadow-md hover:shadow-lg">
            <i class="fas fa-sign-in-alt"></i>
            Ingia Kwenye Mfumo
        </a>
        <a href="https://wa.me/255717685138?text=Sijapokea%20SMS.%20Namba%20yangu%20ya%20kumbukumbu%3A%20{{ $application->payment_reference }}"
           target="_blank"
           class="inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-3 rounded-xl transition shadow-md hover:shadow-lg">
            <i class="fab fa-whatsapp"></i>
            Sijapokea SMS?
        </a>
    </div>

</div>

@endsection
