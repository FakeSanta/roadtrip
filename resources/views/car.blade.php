<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Car') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @if(auth()->user()->isAdmin())
                    <form action="{{ route('car.create') }}" method="GET">
                        @csrf
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</button>
                    </form>
                @endif
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Brand
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Immatriculation
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    @if(auth()->user()->isAdmin())
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$car->name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$car->brand}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$car->immat}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ number_format($car->price, 0, ',',' ') }} €
                                    </td>
                                    @if(auth()->user()->isAdmin())
                                    <td class="px-6 py-4">
                                        <a href="{{ route('car.edit', ['id' => $car->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('car.delete', ['id' => $car->id]) }}" method="POST">
                                            @csrf
                                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</p>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
