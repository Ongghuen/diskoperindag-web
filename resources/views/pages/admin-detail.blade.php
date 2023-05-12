@extends('layouts.mainlayout')

@section('title')
    Detail Admin
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-master btn-sm mb-4" href="/admin"><i class="fa fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Detail Admin</p>
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
                                            <div class="modal-body">Anda yakin akan menyetel ulang password admin ini?</div>
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
                                    <th class="col-2">Name</th>
                                    <td class="col-10">{{ $item->name }}</td>
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