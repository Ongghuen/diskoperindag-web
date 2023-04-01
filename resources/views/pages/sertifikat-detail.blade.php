@extends('layouts.mainlayout')

@section('title')
    Detail Sertifikat
@endsection

@section('title-page')
    Detail Sertifikat
@endsection

@section('tagline')
    Detail data Sertifikat.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <p class="card-title">Detail Sertifikat</p>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nomor Sertifikat</th>
                            <td>{{ $item->no_sertifikat }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $item->nama }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Terbit</th>
                            <td>{{ $item->tanggal_terbit }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Kadaluarsa</th>
                            <td>{{ $item->kadaluarsa_penyelenggara }}</td>
                        </tr>
                        <tr>
                            <th>Penerima</th>
                            <td>{{ $item->user->name }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $item->user->NIK }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $item->keterangan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
