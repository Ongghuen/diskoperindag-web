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
                                    <th>Penerima</th>
                                    <th>Tahun</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bantuanList as $item)
                                    <tr>
                                        <td>{{$loop->iteration + $bantuanList->firstItem() - 1}}</td>
                                        <td>{{$item->nama_bantuan}}</td>
                                        <td>{{$item->jenis_usaha}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->tahun_pemberian}}</td>
                                        <td class="align-middle text-center">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalDetail{{$item->id}}">
                                                detail
                                            </a>
                                        </td>
                                    </tr>
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
                                <th>List Item</th>
                                <td>
                                    <table class="table table-bordered mb-2">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Item</th>
                                            </tr>
                                        </thead>
                                        @foreach ($item->itemBantuan as $data)
                                        <tbody>
                                            <tr>
                                                <td>{{$loop->iteration. '.'}}</td>
                                                <td>{{$data->nama_item}}</td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    <a href="/bantuan-item/{{$item->id}}" class="btn btn-sm btn-primary">Tambah</a>
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
