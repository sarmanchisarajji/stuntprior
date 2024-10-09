@extends('layouts.main')
@section('main-contents')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Management Data Penilaian</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Penilaian</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <form action="{{ url('/admin/data-penilaian') }}" method="GET">
                @csrf
                <div class="d-flex justify-content-end">
                    <!-- Dropdown Pilih Tahun -->
                    <select class="form-select ms-2" name="tahun_pemilihan" aria-label="Pilih Tahun">
                        <option value="">~ Pilih Tahun ~</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('tahun_pemilihan') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Dropdown Pilih Alternatif -->
                    <select class="form-select" name="id_alternatif" aria-label="Pilih Alternatif">
                        <option value="">~ Pilih Alternatif ~</option>
                        @foreach ($alternatifs as $alternatif)
                            <option value="{{ $alternatif->id }}"
                                {{ request('id_alternatif') == $alternatif->id ? 'selected' : '' }}>
                                {{ $alternatif->nama_alternatif }}
                            </option>
                        @endforeach
                    </select>

                    <button class="btn btn-primary ms-2" type="submit">Pilih</button>
                </div>
            </form>

        </div>

        <section class="section">
            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    <span class="ms-2 fw-bold fs-4">Daftar Data Penilaian</span>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kriteria</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penilaians as $penilaian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $penilaian->kriteria->nama_kriteria }}</td>
                                    <td>{{ $penilaian->nilai ?? 'Belum diisi' }}</td>
                                    <td>
                                        @if ($penilaian->id)
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modalEditPenilaian{{ $penilaian->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                        @else
                                            <span class="text-muted">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                </tr>
                                @if ($penilaian->id)
                                    <div class="modal fade" id="modalEditPenilaian{{ $penilaian->id }}">
                                        <div class="modal-dialog modal-dialog-top" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-primary">Edit Penilaian</h5>
                                                    <a href="#" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <em class="icon ni ni-cross"></em>
                                                    </a>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ url('/admin/data-penilaian/edit-penilaian/' . $penilaian->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Hidden fields untuk mengirim tahun_pemilihan dan id_alternatif -->
                                                        <input type="hidden" name="tahun_pemilihan"
                                                            value="{{ request('tahun_pemilihan') }}">
                                                        <input type="hidden" name="id_alternatif"
                                                            value="{{ request('id_alternatif') }}">

                                                        <!-- Pilihan nilai penilaian -->
                                                        <div class="form-group">
                                                            <label
                                                                class="form-label">{{ $penilaian->kriteria->nama_kriteria }}</label>
                                                            <div class="form-control-wrap">
                                                                <select class="form-select" name="nilai" required>
                                                                    <option selected>~ Pilih Rentang Nilai ~</option>
                                                                    @foreach ($penilaian->kriteria->subKriteria as $subkriteria)
                                                                        <option value="{{ $subkriteria->nilai }}"
                                                                            {{ $penilaian->nilai == $subkriteria->nilai ? 'selected' : '' }}>
                                                                            {{ $subkriteria->nama_subkriteria }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Submit button -->
                                                        <div class="form-group mt-3">
                                                            <button type="submit" class="btn btn-sm btn-primary">Update
                                                                Data</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data penilaian</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
