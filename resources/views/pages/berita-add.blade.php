@extends('layouts.mainlayout')

@section('title')
    Tambah Berita
@endsection

@section('title-page')
    Tambah Berita
@endsection

@section('tagline')
    Tambah Berita
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form tambah Berita</h4>
                <form class="forms-sample" action="/beritatambah" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $pesan)
                                    <li>{{ $pesan }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Gambar</label>
                        <input class="form-control" name="image" type="file" id="formFile">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Judul</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="judul"
                            placeholder="Stok">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub Judul</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="subjudul"
                            placeholder="Stok">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Deskripsi</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="body"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                    <a class="btn btn-light btn-sm" href="/berita">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
