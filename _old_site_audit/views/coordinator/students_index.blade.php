<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard ya Training Coordinator - Orodha ya Wanafunzi
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-xs font-bold text-gray-700 uppercase">
                            <th class="p-3 border">Picha</th>
                            <th class="p-3 border">Jina Kamili</th>
                            <th class="p-3 border">Kozi</th>
                            <th class="p-3 border">Simu</th>
                            <th class="p-3 border text-center">Hali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="p-3 text-center">
                                @if($student->passport_photo)
                                    <img src="{{ asset('storage/' . $student->passport_photo) }}" class="w-14 h-14 rounded-full object-cover mx-auto border-2 border-blue-500 shadow-sm">
                                @else
                                    <div class="w-14 h-14 rounded-full bg-gray-200 flex items-center justify-center mx-auto text-[10px] text-gray-400 font-bold uppercase">Picha</div>
                                @endif
                            </td>
                            <td class="p-3 font-bold text-gray-800 uppercase text-sm">
                                {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                            </td>
                            <td class="p-3 text-sm text-gray-600">{{ $student->course_applied }}</td>
                            <td class="p-3 text-sm text-gray-600">{{ $student->phone_number }}</td>
                            <td class="p-3 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $student->admission_status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $student->admission_status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
