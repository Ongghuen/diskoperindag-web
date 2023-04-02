@extends('layouts.mainlayout')

@section('title')
    Sertifikat
@endsection

@section('title-page')
    Sertifikat
@endsection

@section('tagline')
    Kelola data Sertifikat anda.
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <p class="card-title">Table Sertifikat</p>
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
                                    <th>No Sertifikat</th>
                                    <th>Nama Sertifikat</th>
                                    <th>Penerima</th>
                                    <th>NIK</th>
                                    <th>Tanggal Terbit</th>
                                    <th>Tanggal Kadaluarsa</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemList as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + $itemList->firstItem() - 1 }}</td>
                                        <td>{{ $item->no_sertifikat }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->NIK }}</td>
                                        <td>{{ $item->tanggal_terbit }}</td>
                                        <td>{{ $item->kadaluarsa_penyelenggara }}</td>
                                        <td class="align-middle text-center">
                                            <a href="/sertifikat-detail/{{ $item->id }}"
                                                class="btn btn-dark btn-sm px-1 pb-0">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @foreach ($itemList as $item)
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
                                                <form action="/sertfikat-destroy/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <p>Anda Yakin Menghapus Data Sertifikat {{ $item->nama_item }} ?
                                                        </p>
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
                                {{ $itemList->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($itemList as $item)
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
                                    <th>Nama Item</th>
                                    <td>{{ $item->nama_item }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $item->deskripsi }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal detail --}}
        @endforeach
    @endsection