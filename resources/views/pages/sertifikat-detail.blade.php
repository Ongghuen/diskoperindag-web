@extends('layouts.mainlayout')

@section('title')
    Detail Sertifikat
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-4" href="{{ redirect()->back()->getTargetUrl() }}"><i
                                class="fa fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Detail Sertifikat</p>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
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
            </div>
        </div>
    </div>
@endsection
