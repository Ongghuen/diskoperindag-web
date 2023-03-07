@extends('layouts.mainlayout')


@section('title')
    User
@endsection

@section('title-page')
    User
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <p class="card-title">Table User</p>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalTambah"
                            class="btn btn-dark btn-rounded btn-fw ms-auto">Tambah Data</button>
                        {{-- <button class="btn btn-secondary btn-sm ms-auto" data-bs-toggle="modal"
                            data-bs-target="#modal-lokasi">Lokasi</button>
                        <button class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal"
                            data-bs-target="#modal-bayar">Bayar</button>
                        <button class="btn btn-success btn-sm ms-2" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah">Order</button> --}}

                    </div>

                    <ul class="navbar-nav mr-lg-4 w-100">
                        <li class="nav-item nav-search d-none d-lg-block w-100">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="search">
                                        <i class="mdi mdi-magnify"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search now" aria-label="search"
                                    aria-describedby="search">
                            </div>
                        </li>
                    </ul>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table">

                            <thead>

                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>NIK</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>wkwkwkw</td>
                                    <td>wkwkwkwk</td>
                                    <td>wkwkwkwk</td>
                                    <td>wkwkwkwk</td>
                                    <td>wkwkwkwk</td>
                                    <td>wkwkwkwk</td>
                                    <td class="align-middle text-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalHapus"
                                            class="btn btn-danger btn-rounded px-3 py-1 me-1 mt-3">Hapus</button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalUbah"
                                            class="btn btn-warning btn-rounded px-3 py-1 me-1 mt-3">Ubah</button>
                                    </td>
                                </tr>
                                {{-- modal Hapus --}}

                                <div class="modal fade" id="ModalHapus" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Hapus Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <h5>Anda Yakin Menghapus Data ?</h5>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Send message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- end modal Hapus --}}

                                {{-- modal edit --}}

                                <div class="modal fade" id="ModalUbah" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Ubah Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form class="forms-sample">
                                                    <form class="forms-sample">
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername1">Nama</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputUsername1" placeholder="Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Email</label>
                                                            <input type="email" class="form-control"
                                                                id="exampleInputEmail1" placeholder="Email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername1">NIK</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputUsername1" placeholder="NIK">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Address</label>
                                                            <input type="email" class="form-control"
                                                                id="exampleInputEmail1" placeholder="Address">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername1">Phone</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputUsername1" placeholder="Phone">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Gender</label>
                                                            <input type="email" class="form-control"
                                                                id="exampleInputEmail1" placeholder="Gender">
                                                        </div>

                                                    </form>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary me-2">Submit</button>
                                                        <button class="btn btn-light"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- end modal edit --}}
                            </tbody>

                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-3">
                                <li class="page-item disabled">
                                    <a class="page-link">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal add --}}

        <div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nama</label>
                                <input type="text" class="form-control" id="exampleInputUsername1"
                                    placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">NIK</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="NIK">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Phone</label>
                                <input type="text" class="form-control" id="exampleInputUsername1"
                                    placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gender</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Gender">
                            </div>


                        </form>

                        <div class="modal-footer">
                            <button class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>

       


    </div>


    {{-- end modal add --}}
@endsection
