<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard ya Mwanafunzi
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <!-- Dirisha la Ujumbe wa Mafanikio (Success Message) -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 shadow-md rounded-r-lg flex items-center animate-bounce">
                    <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif
            
            <!-- Sehemu ya Kadi za Ada -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Ada Yote -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Ada ya Kozi</p>
                    <p class="text-2xl font-black text-blue-600">TZS {{ number_format($fee) }}</p>
                </div>

                <!-- Alicholipa -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Kiasi Kilicholipwa</p>
                    <p class="text-2xl font-black text-green-600">TZS {{ number_format($paid) }}</p>
                </div>

                <!-- Balanzi -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-red-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Balanzi Inayobaki</p>
                    <p class="text-2xl font-black text-red-600">TZS {{ number_format($balance) }}</p>
                </div>
            </div>

                        <!-- Sehemu ya Malipo ya Ada -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
                <h3 class="text-xl font-bold mb-2 text-gray-800">Lipa Ada Kidogo Kidogo au Yote</h3>
                
                <!-- Paragraph ya Maelekezo ya Awamu za Malipo -->
                <p class="text-gray-600 mb-6 max-w-lg mx-auto leading-relaxed">
                    Malipo ya ada na michango tajwa kwenye fomu yafanyike kwa awamu <strong>Tatu tu</strong> (315,400/=, 135,000/= na 70,000/=).
                </p>
                
                <form action="{{ route('fee.pay') }}" method="POST" class="max-w-xs mx-auto">
                    @csrf
                    <div class="mb-4 relative">
                        <!-- CSS 'appearance-none' inaondoa zile mshale (up/down arrows) -->
                        <input type="number" name="amount" placeholder="Weka kiasi (Mfn: 315400)" 
                            class="[appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-center py-3 text-lg" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition shadow-md uppercase tracking-wider">
                        Lipia Sasa
                    </button>
                </form>
                
                <p class="mt-4 text-xs text-gray-400">Utapokea ujumbe wa PIN kwenye simu yako uliyojisajilia.</p>
            </div>


        </div>
    </div>
</x-app-layout>
