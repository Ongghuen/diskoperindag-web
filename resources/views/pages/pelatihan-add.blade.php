@extends('layouts.mainlayout')

@section('title')
    Tambah Pelatihan
@endsection

@section('title-page')
    Tambah Pelatihan
@endsection

@section('tagline')
    Tambah Pelatihan
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form tambah Pelatihan</h4>
                <form class="forms-sample" action="/pelatihan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nama"
                            name="nama">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Penyelenggara</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="penyelenggara"
                            placeholder="Penyelenggara">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal_pelaksanaan"
                            placeholder="Tanggal Pelaksanaan">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tempat</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempat"
                            placeholder="Tempat">
                    </div>
                    <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                    <a class="btn btn-light btn-sm" href="/pelatihan">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
