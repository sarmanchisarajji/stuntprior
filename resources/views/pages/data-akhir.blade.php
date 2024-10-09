@extends('layouts.main')
@section('main-contents')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Hasil Akhir Perankingan Berdasarkan Tahun</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Hasil Akhir</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @foreach ($groupedScoresByYear as $tahun => $scores)
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-primary">Hasil Perangkingan Tahun : {{ $tahun }}</h5>
                        <table class="table table-striped text-center">
                            <thead>
                                <th>Nama Alternatif</th>
                                <th>Nilai Akhir</th>
                                <th>Rangking</th>
                            </thead>
                            <tbody>
                                @foreach ($scores as $scoreData)
                                    <tr>
                                        <td>{{ $scoreData['alternatif'] }}</td>
                                        <td>{{ number_format($scoreData['score'], 2) }}</td>
                                        <td>{{ $loop->iteration }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        @endforeach
    </div>
@endsection
