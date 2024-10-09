@extends('layouts.main')
@section('main-contents')
    <div class="page-heading">
        <h3>Dashboard STUNTPRIOR</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Data Alternatif</h6>
                                        <h6 class="font-extrabold mb-0">{{ $alternatif }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Data Kriteria</h6>
                                        <h6 class="font-extrabold mb-0">{{ $kriteria }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center justify-content-center align-items-center">Peta Perankingan Alternatif</h2>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="selectYear" class="text-danger fw-bold">Pilih Tahun</label>
                                <select id="selectYear" class="form-control">
                                    <option value="">Semua Tahun</option>
                                    @foreach (array_keys($groupedScoresByYear) as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Div untuk menampilkan peta -->
                        <div id="map"></div>
                        <div id="legend-container" style="display: none;">
                            <h6>Keterangan</h6>
                            <i style="background: blue; width: 18px; height: 18px; display: inline-block;"></i>Normal<br>
                            <i style="background: red; width: 18px; height: 18px; display: inline-block;"></i>
                            Prioritas Penanganan Stunting<br>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <style>
        #map {
            height: 600px;
            width: 100%;
        }

        #legend-container {
            padding: 10px;
            font-size: 14px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }

        #legend-container i {
            margin-right: 5px;
        }
    </style>
@endsection

<script>
    window.onload = function() {
        // Inisialisasi peta Leaflet
        var map = L.map('map').setView([-3.9977177056713193, 122.52673846939604], 12); // Set lokasi awal peta

        // Tambahkan layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            crossOrigin: true
        }).addTo(map);

        // Marker icons
        var blueIcon = L.icon({
            iconUrl: '{{ url('') }}/assets/auth/assets/images/biru.png', // Path to blue marker icon
            iconSize: [40, 40], // size of the icon
            iconAnchor: [12, 41], // point of the icon which will correspond to marker's location
            popupAnchor: [1, -34], // point from which the popup should open relative to the iconAnchor
        });

        var redIcon = L.icon({
            iconUrl: '{{ url('') }}/assets/auth/assets/images/merah.png', // Path to red marker icon
            iconSize: [40, 40],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
        });

        // Data lokasi dari controller (JSON format)
        var groupedScoresByYear = @json($groupedScoresByYear);

        // Menyimpan marker untuk menghindari duplikat
        var markers = {};

        // Fungsi untuk menampilkan data pada peta
        function displayDataOnMap(selectedYear) {
            // Hapus semua marker sebelumnya
            for (var key in markers) {
                if (markers.hasOwnProperty(key)) {
                    map.removeLayer(markers[key]);
                }
            }
            markers = {};

            // Looping data untuk menambahkan marker pada peta
            Object.keys(groupedScoresByYear).forEach(function(year) {
                if (selectedYear && selectedYear !== year) {
                    return; // Skip tahun yang tidak dipilih
                }

                var scores = groupedScoresByYear[year];

                scores.forEach(function(scoreData, index) {
                    var markerKey = scoreData.alternatif + '_' + scoreData.latitude + '_' +
                        scoreData.longitude;

                    // Buat marker hanya jika belum ada
                    if (!markers[markerKey]) {
                        // Tentukan warna marker berdasarkan score
                        var icon = (selectedYear && scoreData.score > 50) ? redIcon : blueIcon;

                        var marker = L.marker([scoreData.latitude, scoreData.longitude], {
                            icon: icon
                        }).addTo(map);

                        // Simpan marker ke dalam objek
                        markers[markerKey] = marker;

                        // Tambahkan pop-up untuk setiap marker
                        var popupContent = `<strong>Nama: ${scoreData.alternatif}</strong><br><br>`;
                        popupContent += `<strong>Tahun: ${year}</strong><br>`;
                        popupContent += `Peringkat: ${index + 1}<br>`;
                        popupContent += `Skor: ${scoreData.score.toFixed(2)}<br>`;
                        popupContent += `C1: ${scoreData.c1}<br>`;
                        popupContent += `C2: ${scoreData.c2}<br>`;
                        popupContent += `C3: ${scoreData.c3}<br>`;
                        popupContent += `C4: ${scoreData.c4}<br>`;

                        marker.bindPopup(popupContent);

                        // Event hover untuk menampilkan pop-up saat kursor diarahkan
                        marker.on('mouseover', function() {
                            this.openPopup();
                        });
                    } else {
                        // Jika marker sudah ada, tambahkan info ke pop-up
                        var existingPopup = markers[markerKey].getPopup();
                        var newPopupContent = existingPopup.getContent() +
                            `<br><strong>Tahun: ${year}</strong><br>
                            Peringkat: ${index + 1}<br>
                            Skor: ${scoreData.score.toFixed(2)}<br>
                            C1: ${scoreData.c1}<br>
                            C2: ${scoreData.c2}<br>
                            C3: ${scoreData.c3}<br>
                            C4: ${scoreData.c4}<br>`;
                        markers[markerKey].bindPopup(newPopupContent);
                    }
                });
            });
        }

        // Event listener untuk dropdown tahun
        document.getElementById('selectYear').addEventListener('change', function() {
            var selectedYear = this.value;
            displayDataOnMap(selectedYear); // Panggil fungsi untuk filter data
        });

        // Tampilkan semua data saat peta pertama kali di-load
        displayDataOnMap('');

        // Tambahkan legenda di bawah atau samping peta
        document.getElementById('selectYear').addEventListener('change', function() {
            var selectedYear = this.value;
            var legendContainer = document.getElementById('legend-container');

            if (selectedYear !== "") {
                // Tampilkan div legend-container jika tahun dipilih
                legendContainer.style.display = "block";
            } else {
                // Sembunyikan legend-container jika tidak ada tahun yang dipilih
                legendContainer.style.display = "none";
            }
        });

    }
</script>
