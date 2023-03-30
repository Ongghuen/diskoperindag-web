@extends('layouts.mainlayout')

@section('title')
    Detail Sertifikat
@endsection

@section('title-page')
    Detail Sertifikat
@endsection

@section('tagline')
    Detail Sertifikat
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <p class="card-title">Detail Sertifikat</p>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Bantuan</th>
                        <td>{{ $item->nama_bantuan }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Usaha</th>
                        <td>{{ $item->jenis_usaha }}</td>
                    </tr>
                    <tr>
                        <th>Penerima</th>
                        <td>{{ $item->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Koordinator</th>
                        <td>{{ $item->koordinator }}</td>
                    </tr>
                    <tr>
                        <th>Sumber Anggaran</th>
                        <td>{{ $item->sumber_anggaran }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Pemberian</th>
                        <td>{{ $item->tahun_pemberian }}</td>
                    </tr>
                    <tr>
                        <th>List Sertifikat</th>
                        <td>
                            <table class="table table-bordered mb-2">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Sertifikat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($item->itemSertifikat as $data)
                                    <tbody>
                                        <tr>
                                            <td>{{ $loop->iteration . '.' }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>
                                                <a href="/delete-item-sertifikat/{{ $data->id }}/{{ $item->id }}"
                                                    class="btn btn-dark btn-sm px-1 pb-0">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <a href="/sertifikat-item/{{ $item->id }}" class="btn btn-sm btn-primary">Tambah</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
