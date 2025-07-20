@extends('admin.layout')

@section('content')
<div class="container py-4">
    <h2>Tambah Data Wisata</h2>
    <form action="{{ url('/admin/wisata/store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Category</label>
            <select class="form-control" name="category_id">
                <option selected disabled>Pilih Salah Satu Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Nama Wisata</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" id="summernote" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pilih Titik Lokasi (Klik atau Cari)</label>
            <div id="map" style="height: 400px;"></div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control" readonly required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Longitude</label>
                <input type="text" id="longitude" name="longtitude" class="form-control" readonly required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

@section('styles')
<!-- Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Leaflet Geosearch -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
@endsection

@push('scripts')
<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $('#summernote').summernote({
        height: 200
    });
</script>

<!-- Leaflet -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- Leaflet GeoSearch -->
<script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/bundle.min.js"></script>
<script>
    const map = L.map('map').setView([-1.2692, 116.8312], 13); // default di Samarinda/Balikpapan
    const marker = L.marker([-1.2692, 116.8312], { draggable: true }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    marker.on('dragend', function (e) {
        const latlng = marker.getLatLng();
        document.getElementById('latitude').value = latlng.lat.toFixed(6);
        document.getElementById('longitude').value = latlng.lng.toFixed(6);
    });

    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
        document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
    });

    const provider = new window.GeoSearch.OpenStreetMapProvider();

    const search = new window.GeoSearch.GeoSearchControl({
        provider: provider,
        style: 'bar',
        autoComplete: true,
        autoCompleteDelay: 250,
        showMarker: false
    });

    map.addControl(search);

    map.on('geosearch/showlocation', function (result) {
        const latlng = result.location;
        marker.setLatLng([latlng.y, latlng.x]);
        map.setView([latlng.y, latlng.x], 15);
        document.getElementById('latitude').value = latlng.y.toFixed(6);
        document.getElementById('longitude').value = latlng.x.toFixed(6);
    });
</script>
@endpush
