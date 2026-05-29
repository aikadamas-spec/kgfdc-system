@extends('layouts.frontend')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- ── Page Header ──────────────────────────────────────────────────────── --}}
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-3">
            {{ __('messages.contact_title') }}
        </h2>
        <span class="inline-block bg-light-blue/10 text-light-blue font-semibold text-sm px-4 py-1.5 rounded-full border border-light-blue/20 mb-4">
            {{ __('messages.contact_subtitle') }}
        </span>
        <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto text-justify">
            {{ __('messages.contact_intro') }}
        </p>
    </div>

    {{-- ── Two-column layout ────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mb-10">

        {{-- ── Contact Form (3/5 width) ─────────────────────────────────────── --}}
        <div class="lg:col-span-3">
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-paper-plane text-light-blue"></i>
                    {{ __('messages.contact_form_title') }}
                </h3>

                @if(session('contact_success'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-6 flex items-center gap-2 text-sm">
                    <i class="fas fa-check-circle"></i>
                    {{ __('messages.contact_success') }}
                </div>
                @endif

                @if(session('contact_error'))
                <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 mb-6 flex items-center gap-2 text-sm">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ __('messages.contact_error') }}
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Name & Phone --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.field_name') }} <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="name" required
                                   placeholder="{{ __('messages.ph_name') }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-light-blue/30 focus:border-light-blue transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.field_phone') }}
                            </label>
                            <input type="tel" name="phone"
                                   placeholder="{{ __('messages.ph_phone') }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-light-blue/30 focus:border-light-blue transition">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ __('messages.field_email') }}
                        </label>
                        <input type="email" name="email"
                               placeholder="{{ __('messages.ph_email') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-light-blue/30 focus:border-light-blue transition">
                    </div>

                    {{-- Subject --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ __('messages.field_subject') }} <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="subject" required
                               placeholder="{{ __('messages.ph_subject') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-light-blue/30 focus:border-light-blue transition">
                    </div>

                    {{-- Message --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ __('messages.field_message') }} <span class="text-red-400">*</span>
                        </label>
                        <textarea name="message" rows="5" required
                                  placeholder="{{ __('messages.ph_message') }}"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-light-blue/30 focus:border-light-blue transition resize-none"></textarea>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-light-blue hover:bg-blue-600 text-white font-bold px-6 py-4 rounded-xl transition shadow-md hover:shadow-lg text-base">
                        <i class="fas fa-paper-plane"></i>
                        {{ __('messages.btn_send') }}
                    </button>
                </form>
            </div>
        </div>

        {{-- ── Contact Info (2/5 width) ─────────────────────────────────────── --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Info card --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
                    <i class="fas fa-address-card text-light-blue"></i>
                    {{ __('messages.contact_info_title') }}
                </h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-gray-700">{{ __('messages.contact_address') }}</p>
                            <p class="text-gray-500 leading-relaxed">Kigamboni FDC, Geza Ulole Road,<br>Kigamboni, Dar es Salaam, Tanzania</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-phone text-xs"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-gray-700">{{ __('messages.contact_phone') }}</p>
                            <a href="tel:+255625771393" class="text-gray-500 hover:text-light-blue transition">+255 625 771 393</a><br>
                            <a href="tel:+255717685138" class="text-gray-500 hover:text-light-blue transition">+255 717 685 138</a>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 rounded-full bg-green-50 text-green-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fab fa-whatsapp text-xs"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-gray-700">{{ __('messages.contact_whatsapp') }}</p>
                            <a href="https://wa.me/255717685138" target="_blank"
                               class="text-gray-500 hover:text-green-500 transition">+255 717 685 138</a>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 rounded-full bg-light-blue/10 text-light-blue flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-clock text-xs"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-gray-700">{{ __('messages.contact_hours') }}</p>
                            <p class="text-gray-500 leading-relaxed">{{ __('messages.contact_hours_text') }}</p>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- Social links --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                <p class="font-semibold text-gray-700 mb-4 text-sm">{{ __('messages.footer_contact') }}</p>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/profile.php?id=61555114508301" target="_blank"
                       class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition" aria-label="Facebook">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="https://www.instagram.com/kigambonifdc/" target="_blank"
                       class="w-10 h-10 rounded-full bg-pink-500 text-white flex items-center justify-center hover:bg-pink-600 transition" aria-label="Instagram">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="https://wa.me/255717685138" target="_blank"
                       class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp text-sm"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Embedded Map ─────────────────────────────────────────────────────── --}}
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 mb-10">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1231.4250409586639!2d39.388099866240076!3d-6.867661567195587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185dcbba1379051b%3A0x3821567ada1dd3ce!2sKIGAMBONI%20FDC!5e1!3m2!1sen!2stz!4v1778470379852!5m2!1sen!2stz"
            width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Kigamboni FDC Location">
        </iframe>
    </div>

</div>

@endsection
