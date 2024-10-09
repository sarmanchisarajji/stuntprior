@extends('layouts.main')
@section('main-contents')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Perhitungan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <!-- Form Pilih Tahun Pemilihan -->
        <section class="section">
            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    <span class="fw-bold fs-4">Pilih Tahun Pemilihan</span>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('perhitungan.index') }}">
                        <div class="row">
                            <div class="col-md-11">
                                <label for="tahun_pemilihan" class="text-danger fw-bolder">Tahun Pemilihan</label>
                                <select id="tahun_pemilihan" name="tahun_pemilihan" class="form-control">
                                    @foreach ($tahunList as $tahun)
                                        <option value="{{ $tahun->tahun_pemilihan }}"
                                            {{ $tahun->tahun_pemilihan == $tahun_pemilihan ? 'selected' : '' }}>
                                            {{ $tahun->tahun_pemilihan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Matriks Keputusan dan Perhitungan SMARTER -->
        <section class="section">
            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    <span class="fw-bold fs-4">Langkah 1: Matriks Keputusan (X) - Tahun: {{ $tahun_pemilihan }}</span>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <th>Nama Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach ($alternatifs as $alternatif)
                                <tr>
                                    <td>{{ $alternatif->nama_alternatif }}</td>
                                    @foreach ($kriterias as $kriteria)
                                        <td>{{ $matriksKeputusan[$alternatif->id][$kriteria->id]->nilai }}</td>
                                    @endforeach
                                </tr>
                            @endforeach

                            <!-- Menampilkan Nilai Max dan Min -->
                            <tr>
                                <th class="bg-info">Nilai Maksimal</th>
                                @foreach ($kriterias as $kriteria)
                                    <td class="bg-info">{{ $maxValues[$kriteria->id] }}</td>
                                @endforeach
                            </tr>

                            <tr>
                                <th class="bg-info">Nilai Minimal</th>
                                @foreach ($kriterias as $kriteria)
                                    <td class="bg-info">{{ $minValues[$kriteria->id] }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <section class="section">
            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span class="ms-2 fw-bold fs-4">Menghitung Nilai Utility - Tahun: {{ $tahun_pemilihan }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <th>Nama Alternatif</th>
                            {{-- <th>Tahun</th> --}}
                            @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach ($alternatifs as $alternatif)
                                <tr>
                                    <td>{{ $alternatif->nama_alternatif }}</td>
                                    {{-- <td>{{ $alternatif->tahun_pemilihan }}</td> --}}
                                    @foreach ($kriterias as $kriteria)
                                        <td>
                                            {{ $normalizedMatrix[$alternatif->id][$kriteria->id]['utility'] }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span class="ms-2 fw-bold fs-4">Menghitung Nilai Akhir - Tahun: {{ $tahun_pemilihan }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <th>Nama Alternatif</th>
                            {{-- <th>Tahun</th> --}}
                            @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th> <!-- Nama kriteria -->
                            @endforeach
                            <th>Nilai Akhir</th>
                        </thead>
                        <tbody>
                            @foreach ($finalScores as $scoreData)
                                <tr>
                                    <td>{{ $scoreData['alternatif'] }}</td>
                                    {{-- <td>{{ $scoreData['tahun_pemilihan'] }} --}}
                                    </td>

                                    <!-- Loop untuk menampilkan nilai akhir tiap kriteria -->
                                    @foreach ($kriterias as $kriteria)
                                        <td>{{ number_format($scoreData['nilaiAkhirPerKriteria'][$kriteria->id], 2) }}</td>
                                    @endforeach

                                    <!-- Score akhir -->
                                    <td>{{ number_format($scoreData['score'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span class="ms-2 fw-bold fs-4">Hasil Perangkingan - Tahun: {{ $tahun_pemilihan }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <th>Ranking</th>
                            <th>Kode Alternatif</th>
                            <th>Nama Alternatif</th>
                            <th>Tahun</th>
                            <th>Nilai Akhir</th>
                        </thead>
                        <tbody>
                            @foreach ($finalScores as $scoreData)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $scoreData['kode_alternatif'] }}
                                    </td>
                                    <td>{{ $scoreData['alternatif'] }}</td>
                                    <td>{{ $scoreData['tahun_pemilihan'] }}
                                    <td>{{ number_format($scoreData['score'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
