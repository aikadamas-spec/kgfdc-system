<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Orodha ya Wanafunzi Waliojisajili (LMS)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-xs font-bold text-gray-600">
                            <th class="p-3 border">Picha</th>
                            <th class="p-3 border">Jina Kamili</th>
                            <th class="p-3 border">Kozi</th>
                            <th class="p-3 border">Simu</th>
                            <th class="p-3 border">Hatua</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border text-center">
                                @if($student->passport_photo)
                                    <img src="{{ asset('storage/' . $student->passport_photo) }}" class="w-12 h-12 rounded-full object-cover mx-auto border shadow-sm">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mx-auto text-[10px]">No Photo</div>
                                @endif
                            </td>
                            <td class="p-3 border">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                            <td class="p-3 border">{{ $student->course_applied }}</td>
                            <td class="p-3 border">{{ $student->phone_number }}</td>
                            <td class="p-3 border">
                                <a href="#" class="bg-blue-600 text-white px-3 py-1 rounded text-xs">Kagua</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
