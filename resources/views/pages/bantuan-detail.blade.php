@extends('layouts.mainlayout')

@section('title')
    Detail Bantuan Alat
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-master btn-sm mb-4" href="{{ redirect()->back()->getTargetUrl() }}"><i
                                class="fa fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Detail Bantuan Alat</p>
                        </div>
                        <div class="table-responsive">
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
                                        <div class="table-responsive">
                                            <table class="my-3 mx-2">
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
                                                                <a href="/delete-item/{{ $data->id }}/{{ $item->id }}"
                                                                    class="btn mx-1 mb-1 btn-outline-light btn-sm">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                        <a href="/bantuan-item/{{ $item->id }}"
                                            class="btn btn-sm btn-master ml-2">Tambah</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
