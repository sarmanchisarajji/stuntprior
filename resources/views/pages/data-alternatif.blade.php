@extends('layouts.main')
@section('main-contents')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            white-space: nowrap;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Management Data Alternatif</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Alternatif</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header text-primary d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        {{-- <i class="ri-barcode-box-line fs-3"></i> --}}
                        <span class="ms-2 fw-bold fs-4">Daftar Data Alternatif</span>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#modalTambahAlternatif">
                        <i class="bi bi-patch-plus me-1"></i> Tambah Data
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Alternatif</th>
                                <th>Jumlah Stunting</th>
                                <th>Jumlah Ibu Hamil</th>
                                <th>Jumlah Ibu Menyusui</th>
                                <th>Anak Berusia 0-23 Bulan</th>
                                <th>BBLR</th>
                                <th>Kepadatan Penduduk</th>
                                <th>Banyak Tenaga Ahli Gizi</th>
                                {{-- <th>Lat</th>
                                <th>Long</th> --}}
                                {{-- <th>File</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatifs as $alternatif)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $alternatif->kode_alternatif }}</td>
                                    <td>{{ $alternatif->nama_alternatif }}</td>
                                    <td>{{ $alternatif->c1 }}</td>
                                    <td>{{ $alternatif->c2 }}</td>
                                    <td>{{ $alternatif->c3 }}</td>
                                    <td>{{ $alternatif->c4 }}</td>
                                    <td>{{ $alternatif->c5 }}</td>
                                    <td>{{ $alternatif->c6 }}</td>
                                    <td>{{ $alternatif->c7 }}</td>
                                    {{-- <td>{{ $alternatif->file_lokasi }}</td> --}}
                                    {{-- <td>{{ round($alternatif->latitude, 3) }}</td>
                                    <td>{{ round($alternatif->longitude, 3) }}</td> --}}
                                    <td>
                                        <span>
                                            <button class="btn btn-sm btn-warning" title="Edit" data-bs-toggle="modal"
                                                data-bs-target="#modalEditAlternatif{{ $alternatif->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                        </span>
                                        <form class="d-inline"
                                            action="{{ url('/admin/data-alternatif/hapus-alternatif/' . $alternatif->id) }}"
                                            method="POST" id="deleteAlternatif{{ $alternatif->id }}">
                                            @csrf
                                            @method('delete')
                                            <span>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete('{{ $alternatif->id }}')">
                                                    <i class="bi bi-trash-fill"></i> Hapus
                                                </button>
                                            </span>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit Alternatif-->
                                <div class="modal fade text-left" id="modalEditAlternatif{{ $alternatif->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel1">
                                                    Form Edit Data Alternatif
                                                </h5>
                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <!-- Horizontal Form without Icons -->
                                                <form
                                                    action="{{ url("/admin/data-alternatif/edit-alternatif/$alternatif->id") }}"
                                                    class="form form-horizontal" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="kode_alternatif">Kode Alternatif</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="kode_alternatif"
                                                                    class="form-control" name="kode_alternatif"
                                                                    value="{{ $alternatif->kode_alternatif }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="nama_alternatif">Nama Alternatif</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="nama_alternatif"
                                                                    class="form-control" name="nama_alternatif"
                                                                    value="{{ $alternatif->nama_alternatif }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="c1">C1</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="c1" class="form-control"
                                                                    name="c1" value="{{ $alternatif->c1 }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="c2">C2</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="c2" class="form-control"
                                                                    name="c2" value="{{ $alternatif->c2 }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="c3">C3</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="c3" class="form-control"
                                                                    name="c3" value="{{ $alternatif->c3 }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="c4">C4</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="c4" class="form-control"
                                                                    name="c4" value="{{ $alternatif->c4 }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="c5">C5</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="c5" class="form-control"
                                                                    name="c5" value="{{ $alternatif->c5 }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="c6">C6</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="c6" class="form-control"
                                                                    name="c6" value="{{ $alternatif->c6 }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="c7">C7</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="c7" class="form-control"
                                                                    name="c7" value="{{ $alternatif->c7 }}"
                                                                    required>
                                                            </div>
                                                            {{-- <div class="col-md-4">
                                                                <label for="latitude">Latitude</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="latitude" class="form-control"
                                                                    name="latitude" value="{{ $alternatif->latitude }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="longitude">Longitude</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="longitude" class="form-control"
                                                                    name="longitude" value="{{ $alternatif->longitude }}"
                                                                    required>
                                                            </div> --}}
                                                            <div class="col-md-4">
                                                                <label for="file_lokasi">File Lokasi</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="file" id="file_lokasi"
                                                                    class="form-control" name="file_lokasi"
                                                                    value="{{ $alternatif->file_lokasi }}">
                                                                @if ($alternatif->file_lokasi)
                                                                    <span>{{ $alternatif->file_lokasi }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="tahun_pemilihan">Tahun Pemilihan</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="tahun_pemilihan"
                                                                    class="form-control" name="tahun_pemilihan"
                                                                    value="{{ $alternatif->tahun_pemilihan }}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Batal</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ml-1">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Update Data</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Modal Tambah Alternatif-->
        <div class="modal fade text-left" id="modalTambahAlternatif" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">
                            Form Tambah Data Alternatif
                        </h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Horizontal Form without Icons -->
                        <form action="{{ url('/admin/data-alternatif/tambah-alternatif') }}" class="form form-horizontal"
                            method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="kode_alternatif">Kode Alternatif</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="kode_alternatif" class="form-control"
                                            name="kode_alternatif" placeholder="Masukan kode alternatif">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nama_alternatif">Nama Alternatif</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="nama_alternatif" class="form-control"
                                            name="nama_alternatif" placeholder="Masukan nama alternatif">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="c1">C1</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="c1" class="form-control" name="c1"
                                            placeholder="Masukan c1">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="c2">C2</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="c2" class="form-control" name="c2"
                                            placeholder="Masukan c2">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="c3">C3</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="c3" class="form-control" name="c3"
                                            placeholder="Masukan c3">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="c4">C4</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="c4" class="form-control" name="c4"
                                            placeholder="Masukan c4">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="c5">C5</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="c5" class="form-control" name="c5"
                                            placeholder="Masukan c5">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="c6">C6</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="c6" class="form-control" name="c6"
                                            placeholder="Masukan c6">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="c7">C7</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="c7" class="form-control" name="c7"
                                            placeholder="Masukan c7">
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <label for="latitude">Latitude</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="latitude" class="form-control" name="latitude"
                                            placeholder="Masukan latitude">
                                    </div> --}}
                                    {{-- <div class="col-md-4">
                                        <label for="longitude">Longitude</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="longitude" class="form-control" name="longitude"
                                            placeholder="Masukan longitude">
                                    </div> --}}
                                    <div class="col-md-4">
                                        <label for="file_lokasi">File Lokasi</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="file" id="file_lokasi" class="form-control" name="file_lokasi"
                                            placeholder="Masukan file lokasi">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tahun_pemilihan">Tahun Pemilihan</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="tahun_pemilihan" class="form-control"
                                            name="tahun_pemilihan" placeholder="Masukan tahun pemilihan">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Batal</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan Data</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        function confirmDelete(alternatifId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah anda yakin ingin menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna menekan "Ya", kirim formulir
                    document.getElementById('deleteAlternatif' + alternatifId).submit();
                }
            });
        }
    </script>
@endsection
