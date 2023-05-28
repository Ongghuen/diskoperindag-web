@extends('layouts.mainlayout')

@section('title')
    Data Berita
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="/berita-destroy" method="POST">
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
                                    <div class="modal-body">Anda yakin akan menghapus berita ini?</div>
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
                        <h4 class="card-title">Data Berita</h4>
                        <div class="align-right text-right">
                            <a class="btn mb-1 btn-outline-primary btn-sm ms-auto" href="/berita-add">Tambah</a>
                            <a class="btn mb-1 btn-outline-danger btn-sm ms-auto mx-1" href="" data-toggle="modal" data-target="#hapusModal">Hapus</a>
                            <a class="btn mb-1 btn-outline-warning btn-sm ms-auto" href="/berita-restore">Terhapus</a>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered zero-configuration" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Judul</th>
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
                                            <td>
                                                @if ($item->image == null)
                                                    <img style="width: 50px; height: 50px;"
                                                        src="{{ asset('images/tuansilat_logo.png') }}" alt="profile">
                                                @else
                                                    <img style="width: 50px; height: 50px;"
                                                        src="{{ asset('images/berita/' . $item['image']) }}" alt="profile">
                                                @endif
                                            </td>
                                            <td>{{ $item->judul }}</td>
                                            <td class="align-middle text-center">
                                                <span>
                                                    <a class="btn mx-1 mb-1 btn-outline-light btn-sm"
                                                        href="/berita-detail/{{ $item->id }}">
                                                        <i class="icon-eye menu-icon"></i>
                                                    </a>

                                                    <a class="btn mx-1 mb-1 btn-outline-light btn-sm"
                                                        href="/berita-edit/{{ $item->id }}">
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
