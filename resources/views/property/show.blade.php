<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Property') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-hidden">
                        <div class="grid grid-cols-3 grid-rows-7 gap-4 relative">
                            <div ><img src="{{ asset('storage/' . $property->picture) }}" class="w-64 h-32 object-cover rounded"></div>
                            <div class="col-start-1 row-start-2">{{ $property->type }}</div>
                            <div class="col-start-1 row-start-3">{{ $property->city }}</div>
                            <div class="col-start-1 row-start-4">{{ number_format($property->price, 0, ',',' ') }} £</div>
                            <div class="col-start-1 row-start-5">{{ $property->surface }} m²</div>
                            <div class="col-start-1 row-start-6">{{ $property->room }} rooms</div>
                            <div class="col-start-1 row-start-7 flex gap-1">@foreach ($property->assets as $asset)
                                    <span class="border border-gray-300 px-2 py-1 rounded bg-blue-100">{{ $asset->nom }}</span>
                                @endforeach</div>
                                <div class="col-span-2 row-span-7 col-start-2 row-start-1 absolute inset-0 w-full border" id="map">
                                <script>
                                    // Récupérer les coordonnées de la vue
                                    var latitude = {{ $geocodeResult[0]['lat'] }};
                                    var longitude = {{ $geocodeResult[0]['lon'] }};

                                    // Initialiser la carte Leaflet
                                    var map = L.map('map').setView([latitude, longitude], 8);

                                    // Ajouter une couche de tuiles OpenStreetMap
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '© OpenStreetMap contributors'
                                    }).addTo(map);

                                    // Ajouter un marqueur aux coordonnées récupérées
                                    L.marker([latitude, longitude]).addTo(map)
                                        .bindPopup('Propriété: {{ $property->name }}<br>Coordonnées: ' + latitude + ', ' + longitude)
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
