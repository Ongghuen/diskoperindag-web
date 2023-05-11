@extends('layouts.mainlayout')

@section('title')
    Data Alat Bantuan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="/item-destroy" method="POST">
                    @csrf
                    {{-- modal Hapus --}}
                    <div class="modal fade" id="hapusModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Modal</h5>
                                    <button type="button" class="close"
                                        data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">Anda yakin akan menghapus data alat ini?</div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                        <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">No</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    {{-- end modal Hapus --}}
                    <div class="card-body">
                        <h4 class="card-title">Data Alat Bantuan</h4>
                        <div class="align-right text-right">
                            <a class="btn mb-1 btn-outline-primary btn-sm ms-auto mr-1" href="/item-add">Tambah</a>
                            <a class="btn mb-1 btn-outline-danger btn-sm ms-auto" href="" data-toggle="modal" data-target="#hapusModal">Hapus</a>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                                </button>

                                <?php
                                
                                $nomer = 1;
                                
                                ?>

                                @foreach ($errors->all() as $error)
                                    <li>{{ $nomer++ }}. {{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah Diberikan</th>
                                        <th>Action</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $no = 1;
                                    
                                    ?>
                                    @foreach ($itemList as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_item }}</td>
                                            <td>
                                                @if ($item->stok == null)
                                                    0
                                                @else
                                                    {{ $item->stok }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center">
                                                <span>
                                                    <a class="btn mx-1 mb-1 btn-outline-light btn-sm"
                                                        href="item-detail/{{ $item->id }}">
                                                        <i class="icon-eye menu-icon"></i>
                                                    </a>

                                                    <a class="btn mx-1 mb-1 btn-outline-light btn-sm"
                                                        href="/item-edit/{{ $item->id }}">
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

