@extends('layouts.mainlayout')

@section('title')
    Data Pengguna
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="/user-destroy" method="POST">
                    @csrf
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
                                    <div class="modal-body">Anda yakin akan menghapus data pengguna ini?</div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                        <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">No</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Hapus --}}
                    <div class="card-body">
                        <h4 class="card-title">Data Pengguna</h4>
                        <div class="align-right text-right">
                            <a class="btn mb-1 mr-1 btn-outline-primary btn-sm ms-auto" href="/user-add">Tambah</a>
                            <a class="btn mb-1 btn-outline-danger btn-sm ms-auto" href="" data-toggle="modal" data-target="#hapusModal">Hapus</a>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered zero-configuration" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Kepala Keluarga</th>
                                        <th>Email</th>
                                        <th>No. Telepon</th>
                                        <th>Usia</th>
                                        <th>Action</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userList as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->NIK }}</td>
                                            <td>{{ $item->kepala_keluarga == '0' ? 'Tidak' : 'Iya' }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->umur }}</td>
                                            <td class="align-middle text-center">
                                                <span>
                                                    <a class="btn mx-1 mb-1 btn-outline-light btn-sm"
                                                        href="/detail-user-bantuan/{{ $item->id }}">
                                                        <i class="icon-eye menu-icon"></i>
                                                    </a>

                                                    <a class="btn mx-1 mb-1 btn-outline-light btn-sm"
                                                        href="/user-edit/{{ $item->id }}">
                                                        <i class="icon-pencil menu-icon"></i>
                                                    </a>
                                                    {{-- <button data-toggle="modal" data-target="#hapusModal{{ $item->id }}"
                                                        type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-danger btn-sm">Delete</button> --}}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="ids[{{$item->id}}]" id="delete" value="{{$item->id}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
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
                    ['10 baris', '25 baris', '50 baris', 'Tampilkan semua']
                ],
                buttons: [{
                        extend: 'colvis',
                        className: 'btn btn-master btn-sm',
                        text: 'Kolom Ditampilkan',
                        // columns: ':gt(0)'
                    },
                    {
                        extend: 'pageLength',
                        className: 'btn btn-master btn-sm',
                        text: 'Baris Ditampilkan',
                        // columns: ':gt(0)'
                    },
                    // 'colvis', 'pageLength',
                    {
                        extend: 'excel',
                        className: 'btn btn-master btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-master btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-master btn-sm',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    // {
                    //     text: 'Rentang Umur',
                    //     className: 'btn btn-master btn-sm dropdown-toggle',
                    //     action: function(e, dt, node, config) {
                    //     var dropdown = $(node).next('.dropdown-menu');
                    //     if (dropdown.length) {
                    //         dropdown.toggle();
                    //     } else {
                    //         dropdown = $('<div class="dropdown-menu" aria-labelledby="dropdownMenuButton"></div>')
                    //         .appendTo($(node).parent());
                    //         $('<a class="dropdown-item">0-30</a>')
                    //         .on('click', function() {
                    //             table.column(6).search('23', true, false).draw();
                    //         })
                    //         .appendTo(dropdown);
                    //         $('<a class="dropdown-item">31-60</a>')
                    //         .on('click', function() {
                    //             table.column(6).search('^31-60$', true, false).draw();
                    //         })
                    //         .appendTo(dropdown);
                    //     }
                    //     }
                    // }
                ],
            });
        });
    </script>
@endsection
