@extends('layouts.mainlayout')

@section('title')
    Data Bantuan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Data Bantuan Alat</p>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Bantuan</th>
                                        <th>Penerima</th>
                                        <th>NIK</th>
                                        <th>Jenis Usaha</th>
                                        <th>Koordinator</th>
                                        <th>Sumber Anggaran</th>
                                        <th>Tanggal Pemberian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $no = 1;
                                    
                                    ?>
                                    @foreach ($bantuanList as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_bantuan }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->NIK }}</td>
                                            <td>{{ $item->user->jenis_usaha }}</td>
                                            <td>{{ $item->koordinator }}</td>
                                            <td>{{ $item->sumber_anggaran }}</td>
                                            <td>{{ $item->tahun_pemberian }}</td>
                                            <td class="align-middle text-center">
                                                <span>
                                                    <a class="btn mx-1 mb-1 btn-outline-light btn-sm"
                                                        href="/bantuan-detail/{{ $item->id }}">
                                                        <i class="icon-eye menu-icon"></i>
                                                    </a>
                                                </span>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-3">
                                    {{ $bantuanList->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav> --}}
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($bantuanList as $item)
                {{-- modal detail --}}
                <div class="modal fade" id="ModalDetail{{ $item->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Nama Bantuan</th>
                                        <td>{{ $item->nama_bantuan }}</td>
                                    </tr>
                                    <tr>
                                        <th>List Item</th>
                                        <td>
                                            <table class="table table-bordered mb-2">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Item</th>
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
                                                                <a
                                                                    href="delete-item/{{ $data->id }}/{{ $item->id }}">
                                                                    hapus
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
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
    {{-- end modal detail --}}
    @endforeach
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

                    // {
                    //     extend: 'csv',
                    //     className: 'btn btn-master btn-sm',
                    //     exportOptions: {
                    //         columns: [0, ':visible']
                    //     }
                    // },
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

                    // 'pageLength', 'colvis',
                    // 'copy', 'csv', 'excel', 'print'

                ],

            });
        });
    </script>
@endsection
