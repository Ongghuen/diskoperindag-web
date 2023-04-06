@extends('layouts.mainlayout')

@section('title')
    Detail Bantuan
@endsection

@section('title-page')
    Detail Bantuan
@endsection

@section('tagline')
    Detail Bantuan
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <p class="card-title">Detail Bantuan</p>
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
                        <th>Tanggal Pemberian</th>
                        <td>{{ $item->tahun_pemberian }}</td>
                    </tr>
                    <tr>
                        <th>List Alat</th>
                        <td>
                            <table class="table table-bordered mb-2">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Alat</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($item->itemBantuan as $data)
                                    <tbody>
                                        <tr>
                                            <td>{{ $loop->iteration . '.' }}</td>
                                            <td>{{ $data->nama_item }}</td>
                                            <td>{{ $data->pivot->kuantitas }}</td>
                                            <td>
                                                <a href="/delete-item/{{$data->id}}/{{$item->id}}" class="btn btn-dark btn-sm px-1 pb-0">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <a href="/bantuan-item/{{ $item->id }}" class="btn btn-sm btn-primary">Tambah</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
