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
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalTambah"
                            class="btn btn-dark btn-fw ms-auto btn-sm">Tambah</button>
                    </div>

                    <ul class="navbar-nav mr-lg-4 w-100">
                        <li class="nav-item nav-search d-none d-lg-block w-100">
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
                    @if(Session::has('status'))
                        <div class="alert alert-success alert-dismissible fade show font-weight-bold my-2" role="alert">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userList as $item)
                                    <tr>
                                        <td>{{$loop->iteration + $userList->firstItem() - 1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->NIK}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td class="align-middle text-center">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalHapus{{$item->id}}">
                                                hapus
                                            </a>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalUbah{{$item->id}}" class="mx-2">
                                                edit
                                            </a>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalDetail{{$item->id}}">
                                                detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @foreach ($userList as $item)
                                    {{-- modal Hapus --}}
                                    <div class="modal fade" id="ModalHapus{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="/user-destroy/{{$item->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <p>Anda Yakin Menghapus Data user {{$item->name}} ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end modal Hapus --}}

                                    {{-- modal edit --}}
                                    <div class="modal fade" id="ModalUbah{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="forms-sample" action="/user-update/{{$item->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">Nama</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="exampleInputUsername1" placeholder="Name" value="{{$item->name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email</label>
                                                        <input type="email" class="form-control"
                                                            id="exampleInputEmail1" name="email" placeholder="Email" value="{{$item->email}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">NIK</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputUsername1" name="NIK" placeholder="NIK" value="{{$item->NIK}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputAlamat1">Alamat</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputAlamat1" placeholder="Address" value="{{$item->alamat}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPhone1">No. Telepon</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputPhone1" placeholder="Phone" value="{{$item->phone}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender">Gender</label>
                                                        <select name="gender" id="gender" class="form-control">
                                                            <option value="{{$item->gender}}">{{$item->gender}}</option>
                                                            @if ($item->gender == 'Laki-Laki')
                                                                <option value="Perempuan">Perempuan</Option>
                                                            @else
                                                                <option value="Laki-Laki">Laki-Laki</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end modal edit --}}
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-3">
                                {{$userList->links('pagination::bootstrap-4')}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($userList as $item)
        {{-- modal detail --}}
        <div class="modal fade" id="ModalDetail{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <td>{{$item->name}}</td>
                            </tr>
                            <tr>
                                <th>email</th>
                                <td>{{$item->email}}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{$item->NIK}}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{$item->alamat}}</td>
                            </tr>
                            <tr>
                                <th>No. Telepon</th>
                                <td>{{$item->phone}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{$item->gender}}</td>
                            </tr>
                            <tr>
                                <th>Bantuan</th>
                                <td>
                                    <ol>
                                        @foreach ($item->bantuan as $data)
                                            <li>{{$data->name}}</li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal detail --}}
        @endforeach

        {{-- modal add --}}
        <div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <form class="forms-sample" action="/user" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">NIK</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1" name="NIK" placeholder="NIK">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputAddress1">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" id="exampleInputAddress1"
                                        placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPhone1">No. Telepon</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputPhone1"
                                        placeholder="No. Telepon">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="Laki-Laki">L</option>
                                        <option value="Perempuan">P</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal add --}}

@endsection
