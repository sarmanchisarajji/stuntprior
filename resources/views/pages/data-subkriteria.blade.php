@extends('layouts.main')
@section('main-contents')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Management Data Sub Kriteria</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Sub Kriteria</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            @foreach ($kriterias as $kriteria)
                <div class="card">
                    <div class="card-header text-primary d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            {{-- <i class="ri-barcode-box-line fs-3"></i> --}}
                            <span class="ms-2 fw-bold fs-4">
                                Daftar Data Sub Kriteria {{ $kriteria->nama_kriteria }} ({{ $kriteria->kode_kriteria }})
                            </span>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#modalTambahSubKriteria{{ $kriteria->id }}">
                            <i class="bi bi-patch-plus me-1"></i> Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sub Kriteria</th>
                                    <th>Nilai</th>
                                    <th>Nama Kriteria</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria->subKriteria as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_subkriteria }}</td>
                                        <td>{{ $item->nilai }}</td>
                                        <td>{{ $kriteria->nama_kriteria }}</td>
                                        <td>
                                            <span>
                                                <button class="btn btn-sm btn-warning" title="Edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditSubKriteria{{ $item->id }}">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                            </span>
                                            <form class="d-inline"
                                                action="{{ url("/admin/data-subkriteria/hapus-subkriteria/$item->id") }}"
                                                method="post" id="deleteSubkriteria{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <span>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete('{{ $item->id }}')">
                                                        <i class="bi bi-trash-fill"></i> Hapus
                                                    </button>
                                                </span>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Sub Kriteria-->
                                    <div class="modal fade text-left" id="modalEditSubKriteria{{ $item->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel1">
                                                        Form Edit Data Sub Kriteria {{ $item->kriteria->nama_kriteria }}
                                                    </h5>
                                                    <button type="button" class="close rounded-pill"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- Horizontal Form without Icons -->
                                                    <form
                                                        action="{{ url("/admin/data-subkriteria/edit-subkriteria/$item->id") }}"
                                                        class="form form-vertical" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="nama_subkriteria">Nama Sub
                                                                            Kriteria</label>
                                                                        <input type="text" id="nama_subkriteria"
                                                                            class="form-control" name="nama_subkriteria"
                                                                            value="{{ $item->nama_subkriteria }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="nilai">nilai</label>
                                                                        <input type="number" step="0.001" id="nilai"
                                                                            class="form-control" name="nilai"
                                                                            value="{{ $item->nilai }}" required>
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

                <!-- Modal Tambah Sub Kriteria-->
                <div class="modal fade text-left" id="modalTambahSubKriteria{{ $kriteria->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel1">
                                    Form Tambah Data Sub Kriteria {{ $kriteria->nama_kriteria }}
                                </h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <!-- Horizontal Form without Icons -->
                                <form action="{{ url("/admin/data-subkriteria/tambah-subkriteria/$kriteria->id") }}"
                                    class="form form-vertical" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="nama_kriteria">Nama Sub Kriteria</label>
                                                    <input type="text" id="nama_subkriteria" class="form-control"
                                                        name="nama_subkriteria" placeholder="Masukan nama sub kriteria"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="nilai">Nilai</label>
                                                    <input type="number" step="0.001" id="nilai"
                                                        class="form-control" name="nilai"
                                                        placeholder="Masukan nama nilai" required>
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
            @endforeach
        </section>
    </div>

    <script>
        function confirmDelete(subkriteriaId) {
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
                    document.getElementById('deleteSubkriteria' + subkriteriaId).submit();
                }
            });
        }
    </script>
@endsection
