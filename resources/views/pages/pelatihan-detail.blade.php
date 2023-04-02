@extends('layouts.mainlayout')

@section('title')
    Detail Pelatihan
@endsection

@section('title-page')
    Detail Pelatihan
@endsection

@section('tagline')
    Detail data pelatihan.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <p class="card-title">Detail Pelatihan</p>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="col-3">Nama</th>
                            <td>{{ $item->nama }}</td>
                        </tr>
                        <tr>
                            <th class="col-3">Penyelenggara</th>
                            <td>{{ $item->penyelenggara }}</td>
                        </tr>
                        <tr>
                            <th class="col-3">Tanggal Pelaksanaan</th>
                            <td>{{ $item->tanggal_pelaksanaan }}</td>
                        </tr>
                        <tr>
                            <th class="col-3">Tempat</th>
                            <td>{{ $item->tempat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection