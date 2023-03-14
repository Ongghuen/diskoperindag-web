@extends('layouts.mainlayout')

@section('title')
    Bantuan
@endsection

@section('title-page')
    Bantuan
@endsection

@section('tagline')
    Kelola data bantuan anda.
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <p class="card-title">Table Bantuan</p>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalTambah"
                            class="btn btn-dark btn-sm btn-fw ms-auto">Tambah</button>
                    </div>
                    <ul class="navbar-nav mr-lg-4 w-100">
                        <li class="nav-item nav-search d-none d-lg-block w-100">
                            <form action="/bantuan" method="GET">
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
                                    <th>Name</th>
                                    <th>Jenis Usaha</th>
                                    <th>Tahun Pemberian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bantuanList as $item)
                                    <tr>
                                        <td>{{$loop->iteration + $bantuanList->firstItem() - 1}}</td>
                                        <td>{{$item->nama_bantuan}}</td>
                                        <td>{{$item->jenis_usaha}}</td>
                                        <td>{{$item->tahun_pemberian}}</td>
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

                                @foreach ($bantuanList as $item)
                                    {{-- modal Hapus --}}
                                    <div class="modal fade" id="ModalHapus{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Hapus Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="/bantuan-destroy/{{$item->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <p>Anda Yakin Menghapus Data {{$item->nama_bantuan}}?</p>
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
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Bantuan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="forms-sample" action="/bantuan-update/{{$item->id}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername1">Nama Bantuan</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputUsername1" placeholder="Name" name="name" value="{{$item->nama_bantuan}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Kategori</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                                placeholder="Kategori" name="category" value="{{$item->jenis_usaha}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary me-2" type="submit">Submit</button>
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
                                {{$bantuanList->links('pagination::bootstrap-4')}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($bantuanList as $item)
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
                                <th>Nama Bantuan</th>
                                <td>{{$item->nama_bantuan}}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{$item->jenis_usaha}}</td>
                            </tr>
                            <tr>
                                <th>User</th>
                                <td>
                                    <ol>
                                        @foreach ($item->users as $data)
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Bantuan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample" action="/bantuan" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nama Bantuan</label>
                                <input type="text" class="form-control" id="exampleInputUsername1"
                                    placeholder="Name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori Bantuan</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Kategori" name="category">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary me-2" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal add --}}
@endsection
