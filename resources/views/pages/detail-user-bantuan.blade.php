@extends('layouts.mainlayout')

@section('title')
    Detail User
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-4" href="/user"><i class="fa fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center mb-2">

                            <p class="card-title">Detail User</p>
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
                                            <table id="example" class="table table-bordered zero-configuration">
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
                                                                <a href="/bantuan-edit/{{ $data->id }}/{{ $item->id }}"
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
                                        </div>
                                        <a href="/user-bantuan/{{ $item->id }}"
                                            class="btn btn-sm btn-primary">Tambah</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pelatihan</th>
                                    <td>
                                        <div class="table-responsive">
                                            <table id="exampleaja" class="table table-bordered zero-configuration">
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
                                                                <a href="/pelatihan-edit/{{ $data->id }}/{{ $item->id }}"
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
                                        </div>
                                        <a href="/user-pelatihan/{{ $item->id }}"
                                            class="btn btn-sm btn-primary">Tambah</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sertifikat</th>
                                    <td>
                                        <div class="table-responsive">
                                            <table id="examplecuy" class="table table-bordered zero-configuration">
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
                                                                <a href="/sertifikat-edit/{{ $data->id }}/{{ $item->id }}"
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
                                        </div>
                                        <a href="/user-sertifikat/{{ $item->id }}"
                                            class="btn btn-sm btn-primary">Tambah</a>
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
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',


                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],

                buttons: [{
                        extend: 'colvis',
                        className: 'btn btn-primary btn-sm',
                        text: 'Column Visibility',
                        // columns: ':gt(0)'


                    },

                    {

                        extend: 'pageLength',
                        className: 'btn btn-primary btn-sm',
                        text: 'Page Length',
                        // columns: ':gt(0)'
                    },


                    // 'colvis', 'pageLength',

                    {
                        extend: 'excel',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // {
                    //     extend: 'csv',
                    //     className: 'btn btn-primary btn-sm',
                    //     exportOptions: {
                    //         columns: [0, ':visible']
                    //     }
                    // },
                    {
                        extend: 'pdf',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    {
                        extend: 'print',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // 'pageLength', 'colvis',
                    // 'copy', 'csv', 'excel', 'print'

                ],

            });
        });
        $(document).ready(function() {
            $('#exampleaja').DataTable({
                dom: 'Bfrtip',


                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],

                buttons: [{
                        extend: 'colvis',
                        className: 'btn btn-primary btn-sm',
                        text: 'Column Visibility',
                        // columns: ':gt(0)'


                    },

                    {

                        extend: 'pageLength',
                        className: 'btn btn-primary btn-sm',
                        text: 'Page Length',
                        // columns: ':gt(0)'
                    },


                    // 'colvis', 'pageLength',

                    {
                        extend: 'excel',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // {
                    //     extend: 'csv',
                    //     className: 'btn btn-primary btn-sm',
                    //     exportOptions: {
                    //         columns: [0, ':visible']
                    //     }
                    // },
                    {
                        extend: 'pdf',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    {
                        extend: 'print',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // 'pageLength', 'colvis',
                    // 'copy', 'csv', 'excel', 'print'

                ],

            });
        });
        $(document).ready(function() {
            $('#examplecuy').DataTable({
                dom: 'Bfrtip',


                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],

                buttons: [{
                        extend: 'colvis',
                        className: 'btn btn-primary btn-sm',
                        text: 'Column Visibility',
                        // columns: ':gt(0)'


                    },

                    {

                        extend: 'pageLength',
                        className: 'btn btn-primary btn-sm',
                        text: 'Page Length',
                        // columns: ':gt(0)'
                    },


                    // 'colvis', 'pageLength',

                    {
                        extend: 'excel',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // {
                    //     extend: 'csv',
                    //     className: 'btn btn-primary btn-sm',
                    //     exportOptions: {
                    //         columns: [0, ':visible']
                    //     }
                    // },
                    {
                        extend: 'pdf',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    {
                        extend: 'print',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },

                    // 'pageLength', 'colvis',
                    // 'copy', 'csv', 'excel', 'print'

                ],

            });
        });
    </script>
@endsection

@section('sweetalert')
    @if (Session::get('update'))
        <script>
            swal("Done", "Data Berhasil Diupdate", "success");
        </script>
    @endif
    @if (Session::get('delete'))
        <script>
            swal("Done", "Data Berhasil Dihapus", "success");
        </script>
    @endif
    @if (Session::get('gagal'))
        <script>
            swal("Gagal Hapus", "Data Masih Terelasi", "error");
        </script>
    @endif
    @if (Session::get('create'))
        <script>
            swal("Done", "Data Berhasil Ditambahkan", "success");
        </script>
    @endif
    @if (Session::get('autocreate'))
        <script>
            swal("Done", "Data Berhasil Ditambahkan", "success");
        </script>
    @endif
@endsection
