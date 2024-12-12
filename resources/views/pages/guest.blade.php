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
                        <h2 class="text-center">Peta Perankingan Alternatif</h2>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <form action="{{ route('guest.dashboard.tahun') }}" method="GET">
                                    <label for="selectYear" class="text-danger fw-bold">Pilih Tahun</label>
                                    <select id="selectYear" name="tahun" class="form-control"
                                        onchange="this.form.submit()">
                                        <option value="">Semua Tahun</option>
                                        @foreach ($tahunList as $year)
                                            <option value="{{ $year->tahun_pemilihan }}"
                                                {{ request('tahun') == $year->tahun_pemilihan ? 'selected' : '' }}>
                                                {{ $year->tahun_pemilihan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="map"></div>
                        <div id="legend-container" style="display: block;">
                            <h6>Keterangan</h6>
                            <i style="background: #006BFF; width: 18px; height: 18px; display: inline-block;"></i> Stunting
                            Rendah, Skor Akhir < 20<br>
                                <i style="background: #08C2FF; width: 18px; height: 18px; display: inline-block;"></i>
                                Stunting Sedang, Skor Akhir 20 - 30<br>
                                <i style="background: #FC8F54; width: 18px; height: 18px; display: inline-block;"></i>
                                Stunting Tinggi, Skor Akhir 30 - 40<br>
                                <i style="background: #C62E2E; width: 18px; height: 18px; display: inline-block;"></i>
                                Stunting Sangat Tinggi, Skor Akhir > 40<br>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if (request('tahun'))
            <section class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Tabel Perangkingan Alternatif</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Alternatif</th>
                                            <th>Skor Akhir</th>
                                            <th>Ranking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $selectedYear = request('tahun');
                                            $filteredScores = collect($groupedScoresByYear)
                                                ->when($selectedYear, function ($collection) use ($selectedYear) {
                                                    return $collection->only($selectedYear);
                                                })
                                                ->flatten(1)
                                                ->sortByDesc('score')
                                                ->values();
                                        @endphp

                                        @foreach ($filteredScores as $index => $score)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $score['alternatif'] }}</td>
                                                <td>{{ number_format($score['score'], 2) }}</td>
                                                <td>{{ $index + 1 }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
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
    <script>
        window.onload = function() {
            // Inisialisasi peta Leaflet
            var map = L.map('map').setView([-3.9977177056713193, 122.52673846939604], 12);

            // Tambahkan layer dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                crossOrigin: true,
            }).addTo(map);

            // Data lokasi dari controller (JSON format)
            var groupedScoresByYear = @json($groupedScoresByYear);

            // Fungsi untuk menampilkan data pada peta berdasarkan tahun
            function displayGeoJSONOnMap(selectedYear) {
                // Hapus semua layer sebelumnya
                map.eachLayer(function(layer) {
                    if (layer instanceof L.GeoJSON) {
                        map.removeLayer(layer);
                    }
                });

                // Looping data berdasarkan tahun
                Object.keys(groupedScoresByYear).forEach(function(year) {
                    if (selectedYear && selectedYear !== year) {
                        return; // Skip tahun yang tidak dipilih
                    }

                    var scores = groupedScoresByYear[year];
                    scores.forEach(function(scoreData, index) {
                        var geojsonFile = '/assets/Kota Kendari/' + scoreData.file_lokasi;

                        // Muat file GeoJSON
                        fetch(geojsonFile)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`Gagal memuat file GeoJSON: ${geojsonFile}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                // Tambahkan GeoJSON ke peta
                                var geojsonLayer = L.geoJSON(data, {
                                    style: function(feature) {
                                        // Ambil nilai skor dari data GeoJSON
                                        var score = scoreData
                                            .score; // Pastikan 'score' ada di properties GeoJSON

                                        // Tentukan warna berdasarkan kondisi score
                                        var color;
                                        if (score < 20) {
                                            color = '#006BFF';
                                        } else if (score >= 20 && score < 30) {
                                            color =
                                                '#08C2FF';
                                        } else if (score >= 30 && score < 40) {
                                            color =
                                                '#FC8F54';
                                        } else if (score >= 40) {
                                            color = '#C62E2E';
                                        }

                                        // Kembalikan gaya untuk fitur ini
                                        return {
                                            color: color, // Warna border
                                            weight: 5, // Ketebalan garis
                                            fillOpacity: 0.7 // Transparansi isian
                                        };
                                    },
                                    onEachFeature: function(feature, layer) {
                                        // Tambahkan pop-up ke setiap polygon
                                        var popupContent =
                                            `<strong>Nama: ${scoreData.alternatif}</strong><br>` +
                                            `<strong>Tahun: ${year}</strong><br>` +
                                            `Peringkat: ${index + 1}<br>` +
                                            `Skor: ${scoreData.score.toFixed(2)}<br>` +
                                            `C1: ${scoreData.c1}<br>` +
                                            `C2: ${scoreData.c2}<br>` +
                                            `C3: ${scoreData.c3}<br>` +
                                            `C4: ${scoreData.c4}<br>` +
                                            `C5: ${scoreData.c5}<br>` +
                                            `C6: ${scoreData.c6}<br>` +
                                            `C7: ${scoreData.c7}<br>`;
                                        layer.bindPopup(popupContent);
                                    }
                                }).addTo(map);
                            })
                            .catch(error => {
                                console.error(`Error loading GeoJSON file (${geojsonFile}):`,
                                    error);
                            });
                    });
                });

            }

            // Tampilkan semua data pada peta saat halaman dimuat
            displayGeoJSONOnMap("{{ request('tahun') }}");

            // Update peta saat tahun dipilih
            document.getElementById('selectYear').addEventListener('change', function() {
                displayGeoJSONOnMap(this.value);
            });
        };
    </script>

    {{-- <script>
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
                iconUrl: '{{ url('') }}/assets/auth/assets/images/biru.png',
                iconSize: [40, 40],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
            });

            var redIcon = L.icon({
                iconUrl: '{{ url('') }}/assets/auth/assets/images/merah.png',
                iconSize: [40, 40],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
            });

            // Data lokasi dari controller (JSON format)
            var groupedScoresByYear = @json($groupedScoresByYear);
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
                            var icon = scoreData.score > 50 ? redIcon : blueIcon;

                            var marker = L.marker([scoreData.latitude, scoreData.longitude], {
                                icon: icon
                            }).addTo(map);
                            markers[markerKey] = marker;

                            // Tambahkan pop-up untuk setiap marker
                            var popupContent = `<strong>Nama: ${scoreData.alternatif}</strong><br>`;
                            popupContent += `<strong>Tahun: ${year}</strong><br>`;
                            popupContent += `Peringkat: ${index + 1}<br>`;
                            popupContent += `Skor: ${scoreData.score.toFixed(2)}<br>`;
                            popupContent += `C1: ${scoreData.c1}<br>`;
                            popupContent += `C2: ${scoreData.c2}<br>`;
                            popupContent += `C3: ${scoreData.c3}<br>`;
                            popupContent += `C4: ${scoreData.c4}<br>`;

                            marker.bindPopup(popupContent);
                            marker.on('mouseover', function() {
                                this.openPopup();
                            });
                        }
                    });
                });
            }

            // Tampilkan semua data pada peta saat halaman dimuat
            displayDataOnMap("{{ request('tahun') }}"); // Memanggil tahun yang dipilih

            // Update peta saat tahun dipilih
            document.getElementById('selectYear').addEventListener('change', function() {
                displayDataOnMap(this.value);
            });
        };
    </script> --}}
@endsection
