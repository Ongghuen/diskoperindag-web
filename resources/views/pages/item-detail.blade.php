@extends('layouts.mainlayout')

@section('title')
    Detail Item Bantuan
@endsection

@section('title-page')
    Detail Item Bantuan
@endsection

@section('tagline')
    Detail data item bantuan.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <p class="card-title">Detail Item Bantuan</p>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
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
@endsection
