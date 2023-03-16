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
                <h4 class="card-title">Form Detail Item Bantuan</h4>

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
                <a class="btn btn-light" href="/item">Cancel</a>

            </div>
        </div>
    </div>
@endsection
