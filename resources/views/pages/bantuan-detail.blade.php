@extends('layouts.mainlayout')

@section('title')
    Detail Bantuan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-4" href="{{ redirect()->back()->getTargetUrl() }}"><i
                                class="fa fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Detail Bantuan</p>
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
                                            <table id="example" class="table table-bordered zero-configuration">
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
                                                                    class="btn btn-dark btn-sm px-1 pb-0">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                        <a href="/bantuan-item/{{ $item->id }}"
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
