@extends('layouts.mainlayout')

@section('title')
    Detail User
@endsection

@section('title-page')
    Detail User
@endsection

@section('tagline')
    Cek detail user beserta bantuannya.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <p class="card-title">Detail User</p>
                    <a class="btn btn-dark btn-fw ms-auto btn-sm" href="{{ url()->previous() }}">Back</a>
                </div>
                <table class="table table-bordered">
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
                                                <a href="/delete-bantuan/{{$data->id}}">hapus</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <a href="/user-bantuan/{{ $item->id }}" class="btn btn-sm btn-primary">Tambah</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
