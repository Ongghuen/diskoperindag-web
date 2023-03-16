@extends('layouts.mainlayout')

@section('title')
    Tambah Bantuan
@endsection

@section('title-page')
    Tambah Bantuan
@endsection

@section('tagline')
    Tambah bantuan ke data user.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form tambah bantuan</h4>
            <form class="forms-sample" action="/user-add-bantuan" method="POST" enctype="multipart/form-data">
                @csrf
                <form class="forms-sample">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="exampleInputUsername1" placeholder="Username" value="{{$user->id}}" name="user_id">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Nama Bantuan</label>
                    <input type="text" class="form-control" id="exampleInputUsername1"
                        placeholder="Nama Bantuan" name="nama_bantuan">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername2">Jenis Usaha</label>
                    <input type="text" class="form-control" id="exampleInputUsername2"
                        placeholder="Jenis Usaha" name="jenis_usaha">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername3">Tahun Pemberian</label>
                    <input type="text" class="form-control" id="exampleInputUsername3"
                        placeholder="Tahun Pemberian" name="tahun_pemberian">
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
            </form>
        </div>
        </div>
    </div>
@endsection

