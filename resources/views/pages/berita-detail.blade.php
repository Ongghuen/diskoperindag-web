@extends('layouts.mainlayout')

@section('title')
    Detail berita
@endsection

@section('title-page')
    Detail berita
@endsection

@section('tagline')
    Detail data berita Anda.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <p class="card-title">Detail Berita</p>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Gambar</th>
                            <td><img src="http://127.0.0.1:8000/images/profile.jpg" alt="profile"></td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $item->judul }}</td>
                        </tr>
                        <tr>
                            <th>Sub Judul</th>
                            <td>{{ $item->subjudul }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $item->body }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
