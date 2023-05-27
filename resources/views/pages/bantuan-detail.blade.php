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
                                    <td>{{ $item->user->jenis_usaha }}</td>
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
                                                        <th>Kuantitas</th>
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
                                                                <a href="" data-toggle="modal" data-target="#editModalAlat{{$data->id}}"
                                                                    class="btn btn-sm btn-outline-light ml-2">
                                                                    <i class="mdi mdi-pencil"></i>
                                                                </a>
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
                                        <a href="" data-toggle="modal" data-target="#addModalAlat"
                                            class="btn btn-sm btn-primary ml-2">Tambah</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Alat --}}
    <div class="modal fade" id="addModalAlat">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Alat</h5>
                    <button type="button" class="close"
                        data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form class="forms-sample" action="/bantuan-add-item" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="select-state">Nama Alat</label>
                            <select class="form-control input-default" id="select-state" name="alat_id">
                                @foreach ($alat as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Kuantitas</label>
                            <input type="number" class="form-control input-default" id="exampleInputUsername1"
                                placeholder="" name="kuantitas">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control input-rounded" id="exampleInputUsername1"
                                placeholder="Username" value="{{ $item->id }}" name="bantuan_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah Alat--}}
    @foreach ($item->itemBantuan as $data)
        {{-- Modal Edit Alat --}}
        <div class="modal fade" id="editModalAlat{{$data->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Alat</h5>
                        <button type="button" class="close"
                            data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" action="/bantuan-qty-update/{{$item->id}}/{{$data->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Kuantitas</label>
                                <input type="number" class="form-control input-default" id="exampleInputUsername1"
                                    placeholder="" name="kuantitas" value="{{$data->pivot->kuantitas}}">
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control input-rounded" id="exampleInputUsername1"
                                    placeholder="Username" value="{{ $item->id }}" name="bantuan_id">
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control input-rounded" id="exampleInputUsername1"
                                    placeholder="Username" value="{{ $data->id }}" name="alat_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Modal Edit Alat--}}
    @endforeach
@endsection

@section('script')
    <script>

    </script>
@endsection
