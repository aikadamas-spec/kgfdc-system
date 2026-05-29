<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight text-center uppercase tracking-widest">
            Fomu ya Usajili na Maombi ya Mafunzo - Kigamboni FDC
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Utepe wa Urujuani Juu -->
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border-t-8 border-indigo-800">
                
                <!-- Kichwa cha Fomu -->
                <div class="p-8 text-center border-b border-gray-100 bg-gradient-to-b from-indigo-50 to-white">
                    <h1 class="text-4xl font-black text-blue-900 tracking-tighter uppercase italic">Kigamboni FDC</h1>
                    <p class="text-gray-500 font-bold uppercase text-xs mt-2 tracking-widest">Digital Enrollment Management System</p>
                </div>

                <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" class="p-10">
                    @csrf

                    <!-- BANGO LA KUPAKUA FOMU (MODERN PURPLE STYLE) -->
                    <div class="mb-10 bg-indigo-50 border-2 border-indigo-200 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-600 p-3 rounded-xl mr-4">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-indigo-900 font-black text-sm uppercase">Fomu ya Daktari (Medical Form)</h3>
                                <p class="text-indigo-700 text-xs font-medium">Pakua, print, kisha nenda hospitali kabla ya kujaza usajili.</p>
                            </div>
                        </div>
                        <a href="{{ asset('downloads/medical_form_template.pdf') }}" target="_blank" class="w-full md:w-auto bg-indigo-700 text-white px-8 py-3 rounded-xl text-xs font-black hover:bg-indigo-800 shadow-xl flex items-center justify-center gap-2 transition-all">
                            PAKUA FOMU HAPA
                        </a>
                    </div>

                    <p class="text-right text-xs text-red-600 font-black mb-6 italic">Sehemu zenye alama ya (*) ni lazima zijazwe.</p>

                    <!-- A. TAARIFA BINAFSI ZA MWANAFUNZI -->
                    <div class="mb-14">
                        <h3 class="bg-gray-50 p-4 font-black border-l-4 border-yellow-500 mb-10 text-blue-900 uppercase text-sm tracking-widest rounded-r-lg shadow-sm">
                            A. TAARIFA BINAFSI ZA MWANAFUNZI
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Jina la Kwanza *</label><input type="text" name="first_name" placeholder="mfn: Juma" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all outline-none shadow-sm" required></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Jina la Kati *</label><input type="text" name="middle_name" placeholder="mfn: Abdallah" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all outline-none shadow-sm" required></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Jina la Mwisho *</label><input type="text" name="last_name" placeholder="mfn: Mussa" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all outline-none shadow-sm" required></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Jinsia *</label><select name="gender" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm" required><option value="Me">Me</option><option value="Ke">Ke</option></select></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Tarehe ya Kuzaliwa *</label><input type="date" name="birth_date" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm" required></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Namba ya NIDA</label><input type="text" name="nida_number" placeholder="mfn: 19900101..." class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm"></div>
                        </div>

                        <!-- Mstari wa 3: Barua Pepe, Simu, na Anwani (Punguzo la ukubwa) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">BARUA PEPE</label><input type="email" name="email_address" placeholder="mfn: mwanafunzi@gmail.com" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">NAMBA YA SIMU *</label><input type="text" name="phone_number" placeholder="mfn: 07xxxxxxxx" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm" required></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">ANWANI YA MAKAZI</label><input type="text" name="residential_address" placeholder="mfn: Kigamboni Na. 5" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                            @foreach(['region' => 'Mkoa *', 'district' => 'Wilaya *', 'ward' => 'Kata *', 'street' => 'Mtaa *'] as $f => $l)
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">{{$l}}</label><input type="text" name="{{$f}}" placeholder="mfn: Dar" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm" required></div>
                            @endforeach
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-black text-gray-700 mb-3 uppercase tracking-widest">Kiwango cha Elimu *</label>
                            <div class="flex flex-wrap gap-6 bg-white p-6 rounded-xl border-2 border-gray-200 shadow-inner">
                                <label class="flex items-center space-x-2"><input type="radio" name="education_level" value="H" class="w-5 h-5 text-indigo-600"><span class="text-sm font-bold">Hakuna</span></label>
                                <label class="flex items-center space-x-2"><input type="radio" name="education_level" value="D7" class="w-5 h-5 text-indigo-600"><span class="text-sm font-bold">Darasa la 7</span></label>
                                <label class="flex items-center space-x-2"><input type="radio" name="education_level" value="F4" class="w-5 h-5 text-indigo-600" checked><span class="text-sm font-bold">Kidato cha 4</span></label>
                                <label class="flex items-center space-x-2"><input type="radio" name="education_level" value="F6" class="w-5 h-5 text-indigo-600"><span class="text-sm font-bold">Kidato cha 6</span></label>
                                <label class="flex items-center space-x-2"><input type="radio" name="education_level" value="SH" class="w-5 h-5 text-indigo-600"><span class="text-sm font-bold">Shahada</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- B. BABA, MAMA, MLEZI (Standard 9 Boxes) -->
                    @foreach(['father' => 'BABA', 'mother' => 'MAMA', 'guardian' => 'MLEZI'] as $key => $title)
                    <div class="mb-14">
                        <h4 class="font-black text-indigo-800 mb-6 uppercase text-sm border-b-2 border-indigo-100 pb-2">TAARIFA ZA {{ $title }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Jina la Kwanza</label><input type="text" name="{{$key}}_first_name" placeholder="mfn: Abdallah" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none shadow-sm transition-all"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Jina la Kati</label><input type="text" name="{{$key}}_middle_name" placeholder="mfn: Juma" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none shadow-sm transition-all"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Jina la Mwisho</label><input type="text" name="{{$key}}_last_name" placeholder="mfn: Mussa" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none shadow-sm transition-all"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Anwani</label><input type="text" name="{{$key}}_address" placeholder="mfn: Kigamboni Na. 10" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm transition-all"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Mkoa</label><input type="text" name="{{$key}}_region" placeholder="mfn: Dar es Salaam" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm transition-all"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Wilaya</label><input type="text" name="{{$key}}_district" placeholder="mfn: Kigamboni" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm transition-all"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Kata</label><input type="text" name="{{$key}}_ward" placeholder="mfn: Kibada" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm transition-all"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Mtaa</label><input type="text" name="{{$key}}_street" placeholder="mfn: Amani" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm transition-all"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">Simu</label><input type="text" name="{{$key}}_phone" placeholder="mfn: 07xxxxxxxx" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm transition-all"></div>
                        </div>
                    </div>
                    @endforeach

                    <!-- 4. TAARIFA ZA MDHAMINI / MFADHILI -->
                    <div class="mb-14">
                        <h4 class="font-black text-indigo-800 mb-6 uppercase text-sm border-b-2 border-indigo-100 pb-2">TAARIFA ZA MDHAMINI / MFADHILI</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">JINA LA KWANZA</label><input type="text" name="sponsor_first_name" placeholder="mfn: Global" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition-all shadow-sm"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">JINA LA PILI</label><input type="text" name="sponsor_middle_name" placeholder="mfn: Vision" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition-all shadow-sm"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">JINA LA TATU</label><input type="text" name="sponsor_last_name" placeholder="mfn: Foundation" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition-all shadow-sm"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">MKOA</label><input type="text" name="sponsor_region" placeholder="mfn: Dar" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">WILAYA</label><input type="text" name="sponsor_district" placeholder="mfn: Ilala" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">KATA</label><input type="text" name="sponsor_ward" placeholder="mfn: Upanga" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">MTAA</label><input type="text" name="sponsor_street" placeholder="mfn: Posta" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">CHEO</label><input type="text" name="sponsor_title" placeholder="mfn: Meneja" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">SHIRIKA</label><input type="text" name="sponsor_organization" placeholder="mfn: ABC Co." class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">SHUGHULI</label><input type="text" name="sponsor_business" placeholder="mfn: Elimu" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">SIMU</label><input type="text" name="sponsor_phone" placeholder="mfn: 07xxxxxxxx" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm"></div>
                            <div><label class="block text-sm font-black text-gray-700 mb-2 uppercase">BARUA PEPE</label><input type="email" name="sponsor_email" placeholder="mfn: sponsor@mail.com" class="w-full rounded-xl border-2 border-gray-300 py-3 px-4 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 shadow-sm"></div>
                        </div>
                    </div>

                    <!-- C. KOZI UNAYOOMBA -->
                    <div class="mb-14">
                        <h3 class="bg-gray-50 p-4 font-black border-l-4 border-yellow-500 mb-10 text-blue-900 uppercase text-sm tracking-widest rounded-r-lg shadow-sm">C. KOZI UNAYOOMBA *</h3>
                        <select name="course" class="w-full rounded-xl border-2 border-gray-300 py-4 px-4 font-black text-gray-700 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all outline-none" required>
                            <option value="">-- CHAGUA KOZI --</option>
                            <optgroup label="Kozi Ndefu">
                                <option value="Ufundi Umeme">Ufundi Umeme</option><option value="Ufundi Magari">Ufundi Magari</option>
                                <option value="Ushonaji">Ushonaji</option><option value="Uashi">Uashi</option>
                                <option value="Uchomeleaji">Uchomeleaji na Uungaji vyuma</option>
                                <option value="Umeme wa Magari">Umeme wa Magari</option><option value="Ufundi bomba">Ufundi bomba</option>
                                <option value="TEHAMA">TEHAMA</option>
                            </optgroup>
                            <optgroup label="Kozi Fupi">
                                <option value="Ufundi Magari Fupi">Ufundi Magari</option><option value="Ushonaji Fupi">Ushonaji</option>
                                <option value="Uashi Fupi">Uashi</option><option value="Ufundi Umeme Fupi">Ufundi Umeme</option>
                                <option value="Uchomeleaji Fupi">Uchomeleaji na Uungaji vyuma</option>
                                <option value="Driving">Udereva (Driving)</option><option value="Computer">Kompyuta</option>
                            </optgroup>
                        </select>
                    </div>

                   <!-- D. VIAMBATANISHO (MODERN STYLE) -->
                    <div class="mb-14">
                        <h3 class="bg-gray-50 p-4 font-black border-l-4 border-yellow-500 mb-10 text-gray-800 uppercase text-sm tracking-widest rounded-r-lg shadow-sm">
                            D. VIAMBATANISHO <span class="text-red-500">*</span>
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-white border-2 border-gray-200 p-8 rounded-3xl shadow-sm hover:border-blue-500 transition-all group">
                                <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors">
                                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                                <label class="block text-xs font-black uppercase text-gray-700 mb-2">Passport Photo *</label>
                                <input type="file" name="passport_photo" class="w-full text-xs font-bold text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                            </div>
                            <div class="bg-white border-2 border-gray-200 p-8 rounded-3xl shadow-sm hover:border-blue-500 transition-all group">
                                <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-red-600 transition-colors">
                                    <svg class="w-6 h-6 text-red-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                                <label class="block text-xs font-black uppercase text-gray-700 mb-2">Medical Form *</label>
                                <input type="file" name="medical_form" class="w-full text-xs font-bold text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-red-50 file:text-red-700 hover:file:bg-red-100" required>
                            </div>
                        </div>
                    </div>


                    <!-- HIFADHI -->
                    <div class="mt-12">
                        <button type="submit" class="w-full bg-indigo-700 text-white py-6 rounded-2xl font-black text-2xl shadow-2xl hover:bg-indigo-800 transition-all transform hover:scale-[1.02] uppercase tracking-tighter">
                            HIFADHI NA KUTUMA MAOMBI
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
