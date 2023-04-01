@extends('layouts.mainlayout')

@section('title')
    Tambah Sertifikat
@endsection

@section('title-page')
    Tambah Sertifikat
@endsection

@section('tagline')
    Tambah Sertifikat
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form tambah Sertifikat</h4>
                <form class="forms-sample" action="/sertifikat" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="exampleInputUsername1" placeholder="Username" value="{{$user->id}}" name="user_id">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">No Sertifikat</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="No Sertifikat"
                            name="no_sertifikat">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nama"
                            name="nama">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal_terbit"
                            placeholder="Tanggal Terbit">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Kadaluarsa Penyelenggara</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="kadaluarsa_penyelenggara"
                            placeholder="Kadaluarsa Penyelenggara">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="keterangan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                    <a class="btn btn-light btn-sm" href="{{ url()->previous() }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
