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
                        <td>{{$item->umur}}</td>
                    </tr>
                    <tr>
                        <th>Bantuan Alat</th>
                        <td>
                            <table class="table table-bordered mb-2">
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
                                                    class="btn btn-dark btn-sm px-1 pb-0 me-1">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                <a href="/bantuan-edit/{{ $data->id }}/{{$item->id}}"
                                                    class="btn btn-dark btn-sm px-1 pb-0 me-1">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="/delete-bantuan/{{ $data->id }}"
                                                    class="btn btn-dark btn-sm px-1 pb-0">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <a href="/user-bantuan/{{ $item->id }}" class="btn btn-sm btn-primary">Tambah</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Pelatihan</th>
                        <td>
                            <table class="table table-bordered mb-2">
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
                                                <a href="/pelatihan-edit/{{ $data->id }}/{{$item->id}}"
                                                    class="btn btn-dark btn-sm px-1 pb-0 me-1">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="/delete-pelatihan/{{ $data->id }}"
                                                    class="btn btn-dark btn-sm px-1 pb-0">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <a href="/user-pelatihan/{{ $item->id }}" class="btn btn-sm btn-primary">Tambah</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Sertifikat</th>
                        <td>
                            <table class="table table-bordered mb-2">
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
                                            <td>{{ $data->no_sertifikat }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->tanggal_terbit }}</td>
                                            <td>{{ $data->kadaluarsa_penyelenggara }}</td>
                                            <td>
                                                <a href="/sertifikat-detail/{{ $data->id }}"
                                                    class="btn btn-dark btn-sm px-1 pb-0 me-1">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                <a href="/sertifikat-edit/{{ $data->id }}/{{$item->id}}"
                                                    class="btn btn-dark btn-sm px-1 pb-0 me-1">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="/delete-sertifikat/{{ $data->id }}"
                                                    class="btn btn-dark btn-sm px-1 pb-0">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <a href="/user-sertifikat/{{ $item->id }}" class="btn btn-sm btn-primary">Tambah</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
