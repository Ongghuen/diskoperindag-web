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
                        <a class="btn btn-master btn-sm mb-4" href="{{ redirect()->back()->getTargetUrl() }}"><i
                                class="fa fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Detail Sertifikat</p>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $sertifikat->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Terbit</th>
                                        <td>{{ $sertifikat->tanggal_terbit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Kadaluarsa</th>
                                        <td>{{ $sertifikat->kadaluarsa_penyelenggara }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>{{ $sertifikat->keterangan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penerima</th>
                                        <td>
                                            <div class="table-responsive">
                                                <table class="my-3 mx-2">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No Sertifikat</th>
                                                            <th scope="col">Nama</th>
                                                            <th scope="col">No Telepon</th>
                                                            <th>Alamat</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($sertifikat->user as $data)
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $data->pivot->no_sertifikat }}</td>
                                                                <td>{{ $data->name }}</td>
                                                                <td>{{ $data->phone }}</td>
                                                                <td>{{ $data->alamat }}</td>
                                                                <td>
                                                                    <a href="/delete-user-sertifikat/{{$data->id}}/{{$sertifikat->id}}"
                                                                        class="btn mx-1 mb-1 btn-outline-light btn-sm">
                                                                        <i class="mdi mdi-delete"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                            <a href="" data-toggle="modal" data-target="#addModal" class="btn btn-sm btn-primary ml-2">Tambah</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penerima</h5>
                    <button type="button" class="close"
                        data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form class="forms-sample" action="/sertifikat-add-user" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="select-state">Penerima</label>
                            <select class="form-control input-default" id="select-state" name="user_id">
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name . ' - ' . $item->NIK}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Nomor Sertifikat</label>
                            <input type="text" class="form-control input-default" id="exampleInputUsername1"
                                placeholder="" name="no_sertifikat">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control input-rounded" id="exampleInputUsername1"
                                placeholder="Username" value="{{ $sertifikat->id }}" name="sertifikat_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div><
    {{-- End Modal Tambah --}}
@endsection
