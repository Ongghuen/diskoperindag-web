@extends('layouts.mainlayout')

@section('title')
    Detail User
@endsection

@section('title-page')
    Detail User
@endsection

@section('tagline')
    Detail User
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Detail User</h4>

                <table class="table table-striped">
                    <tr>
                        <th>Name</th>
                        <td>{{ $item->name }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $item->NIK }}</td>
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
                        <th>Bantuan</th>
                        <td>
                            <table class="table table-bordered mb-2">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Usaha</th>
                                        <th>Tahun</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($item->bantuan as $data)
                                    <tbody>
                                        <tr>
                                            <td>{{ $data->nama_bantuan }}</td>
                                            <td>{{ $data->jenis_usaha }}</td>
                                            <td>{{ $data->tahun_pemberian }}</td>
                                            <td>
                                                <div class="mb-2">
                                                    <a href="">
                                                        edit
                                                    </a>
                                                </div>
                                                <a href="">
                                                    hapus
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <a href="/user-bantuan/{{ $item->id }}" class="btn btn-sm btn-primary">Tambah</a>
                        </td>
                    </tr>
                </table>
                <a class="btn btn-light" href="/user">Cancel</a>

            </div>
        </div>
    </div>
@endsection
