@extends('layouts.mainlayout')

@section('title')
    Detail Bantuan
@endsection

@section('title-page')
    Detail Bantuan
@endsection

@section('tagline')
    Detail Bantuan
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Detail Bantuan</h4>

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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($item->itemBantuan as $data)
                                    <tbody>
                                        <tr>
                                            <td>{{ $loop->iteration . '.' }}</td>
                                            <td>{{ $data->nama_item }}</td>
                                            <td>
                                                <a href="delete-item/{{ $data->id }}/{{ $item->id }}">
                                                    hapus
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <a href="/bantuan-item/{{ $item->id }}" class="btn btn-sm btn-primary">Tambah</a>
                        </td>
                    </tr>
                </table>
                <a class="btn btn-light" href="/bantuan">Cancel</a>

            </div>
        </div>
    </div>
@endsection
