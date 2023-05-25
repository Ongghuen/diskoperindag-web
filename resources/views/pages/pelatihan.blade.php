@extends('layouts.mainlayout')

@section('title')
    Data Pelatihan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="/delete-pelatihan" method="POST">
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
                                        <div class="modal-body">Anda yakin akan menghapus data pelatihan ini?</div>
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
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Data Pelatihan</p>
                        </div>
                        <div class="align-right text-right">
                            <a class="btn mb-1 mr-1 btn-outline-primary btn-sm ms-auto" href="/user-pelatihan">Tambah</a>
                            <a class="btn mb-1 btn-outline-danger btn-sm ms-auto" href="" data-toggle="modal" data-target="#hapusModal">Hapus</a>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelatihan</th>
                                        <th>Penyelenggara</th>
                                        <th>Tanggal Pelaksanaan</th>
                                        <th>Tempat</th>
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
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->penyelenggara }}</td>
                                            <td>{{ $item->tanggal_pelaksanaan }}</td>
                                            <td>{{ $item->tempat }}</td>
                                            <td class="align-middle text-center">
                                                <span>
                                                    <a class="btn mx-1 mb-1 btn-outline-light btn-sm"
                                                        href="/pelatihan-detail/{{ $item->id }}">
                                                        <i class="icon-eye menu-icon"></i>
                                                    </a>

                                                    <a class="btn mx-1 mb-1 btn-outline-light btn-sm"
                                                        href="/pelatihan-edit/{{ $item->id }}">
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
                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-3">
                                    {{ $itemList->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav> --}}
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($itemList as $item)
        {{-- modal detail --}}
        <div class="modal fade" id="ModalDetail{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Nama Item</th>
                                <td>{{ $item->nama_item }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $item->deskripsi }}</td>
                            </tr>
                        </table>
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