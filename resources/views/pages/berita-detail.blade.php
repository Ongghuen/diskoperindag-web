@extends('layouts.mainlayout')

@section('title')
    Detail Berita
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-master btn-sm mb-4" href="/berita"><i class="fa fa-arrow-left"></i></a>
                        <div class="d-flex align-items-center mb-2">
                            <p class="card-title">Detail Berita</p>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Gambar</th>
                                        <td>
                                            @if ($item->image == null)
                                                <img style="width: 100px; height: 100px;"
                                                    src="{{ asset('images/tuansilat_logo.png') }}" alt="profile">
                                            @else
                                                <img style="width: 100px; height: 100px;"
                                                    src="{{ asset('images/berita/' . $item['image']) }}" alt="profile">
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
            </div>
        </div>
    </div>
@endsection
