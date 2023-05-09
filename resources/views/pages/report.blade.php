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
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <ul class="navbar-nav mr-lg-4 w-100 me-3">
                                <li class="nav-item nav-search w-100">
                                    <form action="/report" method="GET">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="search">
                                                    <i class="mdi mdi-magnify"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control me-2" placeholder="Search now"
                                                aria-label="search" aria-describedby="search" name="keyword">
                                            <label for="date1" class="mt-2">Start :</label>
                                            <input type="date" class="form-control mx-2" name="date1" id="date1">
                                            <label for="date2" class="mt-2">Finish :</label>
                                            <input type="date" class="form-control mx-2" name="date2" id="date2">
                                            <button class="btn btn-primary btn-sm ms-1" type="submit">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <form action="/export" method="GET" class="ms-auto mt-3">
                            @if (isset($keyword) && isset($date1) && isset($date2))
                                <input type="hidden" value="{{ $keyword }}" name="data">
                                <input type="hidden" value="{{ $date1 }}" name="date1">
                                <input type="hidden" value="{{ $date2 }}" name="date2">
                            @elseif(isset($keyword) && isset($now) && isset($date2))
                                <input type="hidden" value="{{ $keyword }}" name="data">
                                <input type="hidden" value="{{ $now }}" name="date1">
                                <input type="hidden" value="{{ $date2 }}" name="date2">
                            @elseif(isset($keyword) && isset($date1) && isset($now))
                                <input type="hidden" value="{{ $keyword }}" name="data">
                                <input type="hidden" value="{{ $date1 }}" name="date1">
                                <input type="hidden" value="{{ $now }}" name="date2">
                            @elseif(isset($keyword))
                                <input type="hidden" value="{{ $keyword }}" name="data">
                            @elseif(empty($keyword) && isset($date1) && isset($date2))
                                <input type="hidden" value="{{ $date1 }}" name="date1">
                                <input type="hidden" value="{{ $date2 }}" name="date2">
                            @elseif(empty($keyword) && isset($now) && isset($date2))
                                <input type="hidden" value="{{ $now }}" name="date1">
                                <input type="hidden" value="{{ $date2 }}" name="date2">
                            @elseif(empty($keyword) && isset($date1) && isset($now))
                                <input type="hidden" value="{{ $date1 }}" name="date1">
                                <input type="hidden" value="{{ $now }}" name="date2">
                            @endif
                            <button class="btn btn-primary btn-fw btn-sm" type="submit">Export</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <p class="card-title">Laporan Bantuan Alat</p>
                        </div>
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
                                        <th>Tanggal Pemberian</th>
                                        <th>Usaha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userList as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + $userList->firstItem() - 1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->NIK }}</td>
                                            <td>{{ $item->user->alamat }}</td>
                                            <td>{{ $item->nama_bantuan }}</td>
                                            <td>
                                                @foreach ($item->itemBantuan as $data)
                                                    {{ $data->nama_item }}<br><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($item->itemBantuan as $data)
                                                    {{ $data->pivot->kuantitas }}<br><br>
                                                @endforeach
                                            </td>
                                            <td>{{ $item->tahun_pemberian }}</td>
                                            <td>{{ $item->jenis_usaha }}</td>
                                        </tr>
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

            <div class="col-md-12 stretch-card mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <p class="card-title">Laporan Pelatihan</p>
                        </div>
                        <div class="table-responsive">
                            <table id="recent-purchases-listing-2" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Alamat</th>
                                        <th>Pelatihan</th>
                                        <th>Penyelenggara</th>
                                        <th>Tanggal Pelaksanaan</th>
                                        <th>Tempat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelatihanList as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + $pelatihanList->firstItem() - 1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->NIK }}</td>
                                            <td>{{ $item->user->alamat }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->penyelenggara }}</td>
                                            <td>{{ $item->tanggal_pelaksanaan }}</td>
                                            <td>{{ $item->tempat }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-3">
                                    {{ $pelatihanList->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 stretch-card mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <p class="card-title">Laporan Sertifikat</p>
                        </div>
                        <div class="table-responsive">
                            <table id="recent-purchases-listing-3" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Alamat</th>
                                        <th>Nomor Sertifikat</th>
                                        <th>Sertfikat</th>
                                        <th>Tanggal Terbit</th>
                                        <th>Tanggal Kadaluarsa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sertifList as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + $sertifList->firstItem() - 1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->NIK }}</td>
                                            <td>{{ $item->user->alamat }}</td>
                                            <td>{{ $item->no_sertifikat }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->tanggal_terbit }}</td>
                                            <td>{{ $item->kadaluarsa_penyelenggara }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-3">
                                    {{ $sertifList->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
