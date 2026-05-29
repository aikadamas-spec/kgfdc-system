<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard ya Mratibu wa Mafunzo - Maombi ya Wanafunzi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Jina</th>
                            <th class="border p-2">Simu</th>
                            <th class="border p-2">Hali ya Malipo</th>
                            <th class="border p-2">Kitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $app)
                        <tr>
                            <td class="border p-2">{{ $app->applicant_name }}</td>
                            <td class="border p-2">{{ $app->phone_number }}</td>
                            <td class="border p-2">{{ $app->payment_status }}</td>
                            <td class="border p-2">
                                @if(!$app->form_unlocked)
                                    <form action="{{ route('coordinator.approve', $app->id) }}" method="POST">
                                        @csrf
                                        <button class="bg-blue-500 text-white px-4 py-1 rounded">Approve</button>
                                    </form>
                                @else
                                    <span class="text-green-600 font-bold">Approved</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
