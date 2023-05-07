@extends('layouts.mainlayout')

@section('title')
    Detail berita
@endsection

@section('title-page')
    Detail Berita
@endsection

@section('tagline')
    Detail data berita.
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
                            <td>
                                @if ($item->image == null)
                                    <img src="{{ asset('images/logo-tuansilat-mini.svg') }}" alt="profile">
                                @else
                                    <img src="{{ asset('images/berita/' . $item['image']) }}" alt="profile">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $item->judul }}</td>
                        </tr>
                        <tr>
                            <th>Subjudul</th>
                            <td>{{ $item->subjudul }}</td>
                        </tr>
                        <tr>
                            <th>Content</th>
                            <td>{{ $item->body }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
