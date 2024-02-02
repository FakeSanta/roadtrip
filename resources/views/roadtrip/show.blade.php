<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Road Trip') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nom sommet
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jour de l'ascension
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Coordonnées
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        URL
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roadtrips as $roadtrip)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $roadtrip->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $roadtrip->date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $roadtrip->gps }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ $roadtrip->url }}">Lien de la rando</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form method="GET" action="{{ route('roadtrip.delete', ['id' => $roadtrip->id]) }}">
                                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Suppr.</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>