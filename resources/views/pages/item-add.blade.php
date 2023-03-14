@extends('layouts.mainlayout')

@section('title')
    Tambah Item Bantuan
@endsection

@section('title-page')
    Tambah Item Bantuan
@endsection

@section('tagline')
    Tambah data item bantuan.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form tambah Item Bantuan</h4>
            <form class="forms-sample" action="/item" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputUsername1">Nama Item</label>
                    <input type="text" class="form-control" id="exampleInputUsername1"
                        placeholder="Nama Item" name="nama_item">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Stok</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="stok" placeholder="Stok">
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Deskripsi</label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="deskripsi"></textarea>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a class="btn btn-light" href="/item">Cancel</a>
            </form>
        </div>
        </div>
    </div>
@endsection

