@extends('layouts.mainlayout')

@section('title')
    Detail Pengguna
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-master btn-sm mb-4" href="/user"><i class="fa fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Detail Pengguna</p>
                            <a class="btn mb-1 btn-outline-danger btn-sm ms-auto" href="" data-toggle="modal" data-target="#hapusModal">Reset Password</a>
                            {{-- Modal Hapus --}}
                            <div class="modal fade" id="hapusModal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Modal</h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal"><span>&times;</span>
                                            </button>
                                        </div>
                                            <div class="modal-body">Anda yakin akan menyetel ulang password pengguna ini?</div>
                                            <div class="modal-footer">
                                                <a type="submit" class="btn btn-danger" href="/reset-pw/{{$item->id}}">Yes</a>
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">No</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Hapus --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered zero-configuration">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $item->NIK }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $item->email }}</td>
                                </tr>
                                <tr>
                                    <th>Kepala Keluarga</th>
                                    <td>{{ $item->kepala_keluarga == '0' ? 'Tidak' : 'Iya' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $item->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <td>{{ $item->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    @if ($item->gender == 'P')
                                        <td>Perempuan</td>
                                    @else
                                        <td>Laki-Laki</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>{{ $item->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $item->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Umur</th>
                                    <td>{{ $item->umur }}</td>
                                </tr>
                                <tr>
                                    <th>Bantuan Alat</th>
                                    <td>
                                        <div class="table-responsive">
                                            <table class="my-3 mx-2">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th scope="col">Nama Bantuan</th>
                                                        <th scope="col">Jenis Usaha</th>
                                                        <th>Tanggal Pemberian</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($item->bantuan as $data)
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data->nama_bantuan }}</td>
                                                            <td>{{ $data->jenis_usaha }}</td>
                                                            <td>{{ $data->tahun_pemberian }}</td>
                                                            <td>
                                                                <a href="/bantuan-detail/{{ $data->id }}"
                                                                    class="btn mx-1 mb-1 btn-outline-light btn-sm">
                                                                    <i class="mdi mdi-eye"></i>
                                                                </a>
                                                                <a href="/bantuan-edit/{{ $data->id }}/{{ $item->id }}"
                                                                    class="btn mx-1 mb-1 btn-outline-light btn-sm">
                                                                    <i class="mdi mdi-pencil"></i>
                                                                </a>
                                                                <a href="/delete-bantuan/{{ $data->id }}"
                                                                    class="btn mx-1 mb-1 btn-outline-light btn-sm">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                        <a href="/user-bantuan/{{ $item->id }}"
                                            class="btn btn-sm btn-primary ml-2">Tambah</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pelatihan</th>
                                    <td>
                                        <div class="table-responsive">
                                            <table class="my-3 mx-2">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th scope="col">Nama Pelatihan</th>
                                                        <th scope="col">Penyelenggara</th>
                                                        <th>Tanggal Pelaksanaan</th>
                                                        <th>Tempat</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($item->pelatihan as $data)
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data->nama }}</td>
                                                            <td>{{ $data->penyelenggara }}</td>
                                                            <td>{{ $data->tanggal_pelaksanaan }}</td>
                                                            <td>{{ $data->tempat }}</td>
                                                            <td>
                                                                <a href="/pelatihan-detail/{{ $data->id }}"
                                                                    class="btn mx-1 mb-1 btn-outline-light btn-sm">
                                                                    <i class="mdi mdi-eye"></i>
                                                                </a>
                                                                <a href="/delete-user-pelatihan/{{ $item->id }}/{{ $data->id }}"
                                                                    class="btn mx-1 mb-1 btn-outline-light btn-sm">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                        <a href="" data-toggle="modal" data-target="#addModalPelatihan" class="btn btn-sm btn-primary ml-2">Tambah</a>
                                        <a href="/user-pelatihan" class="btn btn-sm btn-primary ml-2">Pelatihan Baru</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sertifikat</th>
                                    <td>
                                        <div class="table-responsive">
                                            <table class="my-3 mx-2">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th scope="col">Nomor Sertifikat</th>
                                                        <th scope="col">Nama Sertifikat</th>
                                                        <th>Tanggal Terbit</th>
                                                        <th>Tanggal Kadaluarsa</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($item->sertifikat as $data)
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->pivot->no_sertifikat }}</td>
                                                        <td>{{ $data->nama }}</td>
                                                        <td>{{ $data->tanggal_terbit }}</td>
                                                        <td>{{ $data->kadaluarsa_penyelenggara }}</td>
                                                        <td>
                                                            <a href="/sertifikat-detail/{{ $data->id }}"
                                                                class="btn mx-1 mb-1 btn-outline-light btn-sm">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                            <a href="/delete-user-sertifikat/{{ $item->id }}/{{ $data->id }}"
                                                                class="btn mx-1 mb-1 btn-outline-light btn-sm">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                        <a href="" data-toggle="modal" data-target="#addModalSertifikat" class="btn btn-sm btn-primary ml-2">Tambah</a>
                                        <a href="/user-sertifikat" class="btn btn-sm btn-primary ml-2">Sertifikat Baru</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Tambah Pelatihan --}}
    <div class="modal fade" id="addModalPelatihan">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelatihan</h5>
                    <button type="button" class="close"
                        data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form class="forms-sample" action="/pelatihan-add-user" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group col-12">
                            <select class="form-control input-default" id="select-state" name="pelatihan_id">
                                @foreach ($pelatihan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama . ' - ' . $data->penyelenggara}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control input-rounded" id="exampleInputUsername1"
                                placeholder="Username" value="{{ $item->id }}" name="user_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah Pelatihan --}}
    {{-- Modal Tambah Sertifikat --}}
    <div class="modal fade" id="addModalSertifikat">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sertifikat</h5>
                    <button type="button" class="close"
                        data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form class="forms-sample" action="/sertifikat-add-user" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="select-state">Penerima</label>
                            <select class="form-control input-default" id="select-state" name="sertifikat_id">
                                @foreach ($sertifikat as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
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
                                placeholder="Username" value="{{ $item->id }}" name="user_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah Sertifikat--}}
@endsection

@section('script')
    <script>
        
    </script>
@endsection