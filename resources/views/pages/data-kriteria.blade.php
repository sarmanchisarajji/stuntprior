@extends('layouts.main')
@section('main-contents')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Management Data Kriteria</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Kriteria</li>
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
                        <span class="ms-2 fw-bold fs-4">Daftar Data Kriteria</span>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#modalTambahKriteria">
                        <i class="bi bi-patch-plus me-1"></i> Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Jenis Kriteria</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriterias as $kriteria)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kriteria->kode_kriteria }}</td>
                                    <td>{{ $kriteria->nama_kriteria }}</td>
                                    <td>{{ $kriteria->bobot }}</td>
                                    <td>{{ Str::ucfirst($kriteria->jenis_kriteria) }}</td>
                                    <td>
                                        <span>
                                            <button class="btn btn-sm btn-warning" title="Edit" data-bs-toggle="modal"
                                                data-bs-target="#modalEditKriteria{{ $kriteria->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                        </span>
                                        <form class="d-inline"
                                            action="{{ url("/admin/data-kriteria/hapus-kriteria/$kriteria->id") }}"
                                            method="post" id="deleteKriteria{{ $kriteria->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <span>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete('{{ $kriteria->id }}')">
                                                    <i class="bi bi-trash-fill"></i> Hapus
                                                </button>
                                            </span>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit Kriteria-->
                                <div class="modal fade text-left" id="modalEditKriteria{{ $kriteria->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel1">
                                                    Form Edit Data Kriteria
                                                </h5>
                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <!-- Horizontal Form without Icons -->
                                                <form
                                                    action="{{ url("/admin/data-kriteria/edit-kriteria/$kriteria->id") }}"
                                                    class="form form-vertical" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="kode_kriteria">Kode Kriteria</label>
                                                                    <input type="text" id="kode_kriteria"
                                                                        class="form-control" name="kode_kriteria"
                                                                        value="{{ $kriteria->kode_kriteria }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="nama_kriteria">Nama Kriteria</label>
                                                                    <input type="text" id="nama_kriteria"
                                                                        class="form-control" name="nama_kriteria"
                                                                        value="{{ $kriteria->nama_kriteria }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="bobot">Bobot</label>
                                                                    <input type="number" step="0.001" id="bobot"
                                                                        class="form-control" name="bobot"
                                                                        value="{{ $kriteria->bobot }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="jenis_kriteria">Jenis Kriteria</label>
                                                                    <fieldset class="form-group">
                                                                        <select class="form-select" id="basicSelect"
                                                                            name="jenis_kriteria" required>
                                                                            <option value="benefit"
                                                                                {{ $kriteria->jenis_kriteria == 'benefit' ? 'selected' : '' }}>
                                                                                Benefit</option>
                                                                            <option value="cost"
                                                                                {{ $kriteria->jenis_kriteria == 'cost' ? 'selected' : '' }}>
                                                                                Cost</option>
                                                                        </select>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <button type="button" class="btn btn-danger me-1"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Batal</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ml-1">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Update Data</span>
                                                                </button>
                                                            </div>
                                                        </div>
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

        <!-- Modal Tambah Kriteria-->
        <div class="modal fade text-left" id="modalTambahKriteria" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">
                            Form Tambah Data Kriteria
                        </h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Horizontal Form without Icons -->
                        <form action="{{ url('/admin/data-kriteria/tambah-kriteria') }}" class="form form-vertical"
                            method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="kode_kriteria">Kode Kriteria</label>
                                            <input type="text" id="kode_kriteria" class="form-control"
                                                name="kode_kriteria" placeholder="Masukan kode kriteria" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="nama_kriteria">Nama Kriteria</label>
                                            <input type="text" id="nama_kriteria" class="form-control"
                                                name="nama_kriteria" placeholder="Masukan nama kriteria" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="bobot">Bobot</label>
                                            <input type="number" step="0.001" id="bobot" class="form-control"
                                                name="bobot" placeholder="Masukan nama bobot" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="jenis_kriteria">Jenis Kriteria</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" name="jenis_kriteria"
                                                    required>
                                                    <option selected>~ Pilih Jenis Kriteria ~</option>
                                                    <option value="benefit">Benefit</option>
                                                    <option value="cost">Cost</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Simpan Data</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function confirmDelete(kriteriaId) {
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
                    document.getElementById('deleteKriteria' + kriteriaId).submit();
                }
            });
        }
    </script>
@endsection
