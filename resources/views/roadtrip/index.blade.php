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
                            <label for="agency" class="flex-shrink-0 flex items-center text-sm font-medium text-gray-900 dark:text-white">Road Trip de BZZ SA MERRR !! : &nbsp</label>
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
                            <button id="changeBasemap" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Changer de vue</button>
                            <button id="toggleLayers" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">Tracé rando</button>

                        </div>
                    @endif

                    <div class="mb-4" id="map" style="width: 100%; height: 600px;"></div>

                    <script>
                        var map = L.map('map').setView([46.509132871873994, 9.42789248610971], 7);
                        var currentBasemap = L.tileLayer.provider('Esri.WorldImagery').addTo(map);

                        var basemaps = [
                            L.tileLayer.provider('Esri.WorldImagery'),
                            L.tileLayer.provider('OpenTopoMap'),
                            L.tileLayer.provider('OpenStreetMap.Mapnik')
                        ];

                        var currentBasemap = basemaps[0].addTo(map);

                        var esriWorldImageryGroup = L.layerGroup([
                            L.tileLayer('https://tiles.stadiamaps.com/tiles/stamen_terrain_labels/{z}/{x}/{y}{r}.{ext}', {
                                minZoom: 0,
                                maxZoom: 18,
                                attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                                ext: 'png'
                            }),
                            L.tileLayer('https://tile.waymarkedtrails.org/hiking/{z}/{x}/{y}.png', {
                                maxZoom: 18,
                                attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors | Map style: &copy; <a href="https://waymarkedtrails.org">waymarkedtrails.org</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
                            })
                        ]);

                        var layersApplied = false;

                        function changeBasemap() {
                            // Changez la basemap en utilisant l'index dans le tableau
                            var currentIndex = basemaps.indexOf(currentBasemap);
                            var nextIndex = (currentIndex + 1) % basemaps.length;

                            map.removeLayer(currentBasemap);
                            currentBasemap = basemaps[nextIndex].addTo(map);
                        }

                        function toggleLayers() {
                            // Inversez l'état des couches supplémentaires
                            layersApplied = !layersApplied;

                            if (layersApplied) {
                                esriWorldImageryGroup.addTo(map);
                            } else {
                                esriWorldImageryGroup.removeFrom(map);
                            }
                        }


                        document.getElementById('changeBasemap').addEventListener('click', changeBasemap);
                        document.getElementById('toggleLayers').addEventListener('click', toggleLayers);

                        var roadtrips = @json($roadtrips);
                        var markerCoordinates = [];
                        roadtrips.forEach(function (roadtrip) {
                            var coordinates = roadtrip.gps.split(', ');
                            var latitude = parseFloat(coordinates[0]);
                            var longitude = parseFloat(coordinates[1]);

                            var marker = L.marker([latitude, longitude]).addTo(map)
                                .bindPopup(roadtrip.name + "</br><a href='" + roadtrip.url + "' target='blank'>Lien</a>");

                            marker.date = new Date(roadtrip.date);  // Assurez-vous que la propriété date est un objet Date
                            markerCoordinates.push([latitude, longitude, marker.date]);  // Ajoutez la date à la liste
                        });

                        // Triez la liste par date
                        markerCoordinates.sort(function(a, b) {
                            return a[2] - b[2];
                        });

                        // Créez une ligne entre les marqueurs triés
                        L.polyline(markerCoordinates, { color: 'red' }).addTo(map);
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
