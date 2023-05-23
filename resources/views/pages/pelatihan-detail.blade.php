@extends('layouts.mainlayout')

@section('title')
    Detail Pelatihan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-master btn-sm mb-4" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Detail Pelatihan</p>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="col-3">Nama</th>
                                        <td>{{ $pelatihan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-3">Penyelenggara</th>
                                        <td>{{ $pelatihan->penyelenggara }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-3">Tanggal Pelaksanaan</th>
                                        <td>{{ $pelatihan->tanggal_pelaksanaan }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-3">Tempat</th>
                                        <td>{{ $pelatihan->tempat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Peserta</th>
                                        <td>
                                            <div class="table-responsive">
                                                <table class="my-3 mx-2">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th scope="col">Nama</th>
                                                            <th scope="col">No Telepon</th>
                                                            <th>Alamat</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($pelatihan->user as $data)
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $data->name }}</td>
                                                                <td>{{ $data->phone }}</td>
                                                                <td>{{ $data->alamat }}</td>
                                                                <td>
                                                                    <a href="/delete-user-pelatihan/{{$data->id}}/{{$pelatihan->id}}"
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
                    <h5 class="modal-title">Tambah Peserta</h5>
                    <button type="button" class="close"
                        data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form class="forms-sample" action="/pelatihan-add-user" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group col-12">
                            <select class="form-control input-default" id="select-state" name="user_id">
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name . ' - ' . $item->NIK}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control input-rounded" id="exampleInputUsername1"
                                placeholder="Username" value="{{ $pelatihan->id }}" name="pelatihan_id">
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
