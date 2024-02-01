<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roadtrip') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex gap-3">
                        <div class="w-80 flex">
                            <label for="agency" class="flex-shrink-0 flex items-center text-sm font-medium text-gray-900 dark:text-white">Road Trip de BZZ SA MERRR : &nbsp</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(auth()->user()->isAdmin())
                        <div class="flex gap-2 mb-2">
                            <form action="{{ route('roadtrip.create') }}" method="GET">
                                @csrf
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add New Rando</button>
                            </form>
                            <form action="{{ route('roadtrip.show') }}" method="GET">
                                @csrf
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete Rando</button>
                            </form>
                        </div>
                    @endif

                    <div class="mb-4" id="map" style="width: 100%; height: 600px;"></div>

                    <script>
                        var map = L.map('map').setView([46.509132871873994, 9.42789248610971], 7);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap contributors'
                        }).addTo(map);

                        // Préparer les données côté Blade avant d'entrer dans la balise script
                        var roadtrips = @json($roadtrips);
                        console.log(roadtrips);
                        // Votre script JavaScript ici
                        roadtrips.forEach(function (roadtrip) {
                            var coordinates = roadtrip.gps.split(', ');
                            var latitude = parseFloat(coordinates[0]);
                            var longitude = parseFloat(coordinates[1]);

                            L.marker([latitude, longitude]).addTo(map)
                                .bindPopup(roadtrip.name+"</br><a href='"+roadtrip.url+"'target='blank'>Lien</a>");

                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
