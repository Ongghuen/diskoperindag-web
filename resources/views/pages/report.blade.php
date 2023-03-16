@extends('layouts.mainlayout')

@section('title')
    Laporan
@endsection

@section('title-page')
    Laporan
@endsection

@section('tagline')
    Kelola data laporan anda.
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <p class="card-title">Table Laporan</p>
                        <a class="btn btn-dark btn-fw ms-auto btn-sm" href="/export">Export</a>
                    </div>
                    <ul class="navbar-nav mr-lg-4 w-100">
                        <li class="nav-item nav-search d-none d-lg-block w-100">
                            <form action="/report" method="GET">
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
                                    <th>Alamat</th>
                                    <th>Bantuan</th>
                                    <th>Alat</th>
                                    <th>Qty</th>
                                    <th>Tahun</th>
                                    <th>Usaha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userList as $item)
                                    <tr>
                                        <td>{{$loop->iteration + $userList->firstItem() - 1}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->user->NIK}}</td>
                                        <td>{{$item->user->alamat}}</td>
                                        <td>{{$item->nama_bantuan}}</td>
                                        <td>
                                            @foreach ($item->itemBantuan as $data)
                                                {{$data->nama_item}}<br><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($item->itemBantuan as $data)
                                                {{$data->pivot->kuantitas}}<br><br>
                                            @endforeach
                                        </td>
                                        <td>{{$item->tahun_pemberian}}</td>
                                        <td>{{$item->jenis_usaha}}</td>
                                    </tr>
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
@endsection
