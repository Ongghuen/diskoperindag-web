@extends('layouts.mainlayout')

@section('title')
    Data Berita
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Table Berita</p>
                            {{-- <a class="btn btn-primary btn-fw ms-auto btn-sm" href="/berita-add">Tambah</a> --}}
                            <a class="btn mb-1 btn-rounded btn-outline-primary btn-sm ms-auto" href="/berita-add">Add</a>
                        </div>
                        {{-- <ul class="navbar-nav mr-lg-4 w-100">
                            <li class="nav-item nav-search w-100">
                                <form action="" method="GET">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="search">
                                                <i class="mdi mdi-magnify"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search now"
                                            aria-label="search" aria-describedby="search" name="keyword">
                                    </div>
                                </form>
                            </li>
                        </ul> --}}
                        {{-- @if (Session::has('status'))
                            <div class="alert alert-success alert-dismissible fade show font-weight-bold my-2"
                                role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif --}}

                        <div class="table-responsive">
                            <table id="example" class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                        <th>Action</th>
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
                                                        src="{{ asset('images/logo-tuansilat-mini.svg') }}" alt="profile">
                                                @else
                                                    <img style="width: 50px; height: 50px;"
                                                        src="{{ asset('images/berita/' . $item['image']) }}" alt="profile">
                                                @endif
                                            </td>
                                            <td>{{ $item->judul }}</td>
                                            <td class="align-middle text-center">
                                                <span>
                                                    <a class="btn mb-1 btn-rounded btn-outline-success btn-sm"
                                                        href="/berita-detail/{{ $item->id }}">Detail</a>

                                                    <a class="btn mb-1 btn-rounded btn-outline-warning btn-sm"
                                                        href="/berita-edit/{{ $item->id }}">Edit</a>

                                                    <button data-toggle="modal" data-target="#hapusModal{{ $item->id }}"
                                                        type="button"
                                                        class="btn mb-1 btn-rounded btn-outline-danger btn-sm">Delete</button>

                                                </span>

                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach ($itemList as $item)
                                        {{-- modal Hapus --}}
                                        <div class="modal fade" id="hapusModal{{ $item->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Modal</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/berita-destroy/{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">Anda Yakin Akan Menghapus Data
                                                            {{ $item->name }}?</div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">No</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end modal Hapus --}}
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
