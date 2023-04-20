@extends('layouts.mainlayout')


@section('title')
    User
@endsection

@section('title-page')
    User
@endsection

@section('tagline')
    Kelola data pengguna anda.
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <p class="card-title">Table User</p>
                        <a class="btn btn-primary btn-fw ms-auto btn-sm me-2" href="/user-add">Tambah</a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Umur
                            </button>
                            <div class="dropdown-menu dropdown-menu-sm">
                                <a class="dropdown-item" href="/umur0-20">0 - 20</a>
                                <a class="dropdown-item" href="/umur21-30">21 - 30</a>
                                <a class="dropdown-item" href="/umur31-40">31 - 40</a>
                                <a class="dropdown-item" href="/umur41-50">41 - 50</a>
                                <a class="dropdown-item" href="/umur51++">51++</a>
                            </div>
                          </div>
                    </div>
                    <ul class="navbar-nav mr-lg-4 w-100">
                        <li class="nav-item nav-search w-100">
                            <form action="" method="GET">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="search">
                                            <i class="mdi mdi-magnify"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search now" aria-label="search"
                                        aria-describedby="search" name="keyword">
                                </div>
                            </form>
                        </li>
                    </ul>
                    @if (Session::has('status'))
                        <div class="alert alert-success alert-dismissible fade show font-weight-bold my-2" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    {{-- <th>Umur</th> --}}
                                    <th>Kepala Keluarga</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userList as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + $userList->firstItem() - 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->NIK }}</td>
                                        {{-- <td>{{ $age = \Carbon\Carbon::parse($item->tanggal_lahir)->age }}</td> --}}
                                        <td>{{ $item->kepala_keluarga == '0' ? 'Tidak' : 'Iya' }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td class="align-middle text-center">
                                            <a href="/detail-user-bantuan/{{ $item->id }}"
                                                class="btn btn-dark btn-sm px-1 pb-0">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="/user-edit/{{ $item->id }}"
                                                class="mx-2 btn btn-dark btn-sm px-1 pb-0">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#ModalHapus{{ $item->id }}"
                                                class="btn btn-dark btn-sm px-1 pb-0">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @foreach ($userList as $item)
                                    {{-- modal Hapus --}}
                                    <div class="modal fade" id="ModalHapus{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="/user-destroy/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <p>Anda Yakin Menghapus Data user {{ $item->name }} ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end modal Hapus --}}
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-3">
                                {{ $userList->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($userList as $item)
            {{-- modal detail --}}
            <div class="modal fade" id="ModalDetail{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $item->NIK }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $item->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <td>{{ $item->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    @if ($item->gender == 'P')
                                        <td>Perempuan</td>
                                    @else
                                        <td>Laki-Laki</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Bantuan</th>
                                    <td>
                                        <table class="table table-bordered mb-2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Jenis Usaha</th>
                                                    <th>Tahun</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            @foreach ($item->bantuan as $data)
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $data->nama_bantuan }}</td>
                                                        <td>{{ $data->jenis_usaha }}</td>
                                                        <td>{{ $data->tahun_pemberian }}</td>
                                                        <td>
                                                            <div class="mb-2">
                                                                <a href="">
                                                                    edit
                                                                </a>
                                                            </div>
                                                            <a href="">
                                                                hapus
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                        <a href="/user-bantuan/{{ $item->id }}"
                                            class="btn btn-sm btn-primary">Tambah</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal detail --}}
        @endforeach
    @endsection
