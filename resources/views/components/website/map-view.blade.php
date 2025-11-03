@props([
    'latitude' => 0,
    'longitude' => 0,
    'height' => 400,
])
@push('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <script>
        var latitude = {{ $latitude }};
        var longitude = {{ $longitude }};
        var map = L.map('map').setView([latitude, longitude], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map);
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <style>
        #map {
            height: {{$height}}px; }
    </style>
@endpush
<div
    class="w-full leading-[0] border-0 mt-6"
    id="map"></div>