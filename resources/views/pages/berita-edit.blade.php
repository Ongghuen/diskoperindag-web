@extends('layouts.mainlayout')

@section('title')
    Edit Berita
@endsection

@section('title-page')
    Edit Berita
@endsection

@section('tagline')
    Edit Berita
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Edit Berita</h4>
                <form class="forms-sample" action="/berita-update/{{ $item->id }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $pesan)
                                    <li>{{ $pesan }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- <div class="form-group">
                        <label for="exampleInputUsername1">Gambar</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nama Item"
                            name="nama_item" value="{{ $item->image }}">
                    </div> --}}
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Gambar</label>
                        <input class="form-control" name="image" type="file" id="formFile">
                      </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Judul</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="judul" placeholder="Stok"
                            value="{{ $item->judul }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub Judul</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="subjudul" placeholder="Stok"
                            value="{{ $item->subjudul }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Deskripsi</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="body">{{ $item->body }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                    <a class="btn btn-light btn-sm" href="/berita">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
