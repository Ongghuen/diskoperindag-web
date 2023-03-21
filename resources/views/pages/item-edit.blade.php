@extends('layouts.mainlayout')

@section('title')
    Edit Item Bantuan
@endsection

@section('title-page')
    Edit Item Bantuan
@endsection

@section('tagline')
    Edit data item bantuan.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form Edit Item Bantuan</h4>
            <form class="forms-sample" action="/item-update/{{$item->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputUsername1">Nama Item</label>
                    <input type="text" class="form-control" id="exampleInputUsername1"
                        placeholder="Nama Item" name="nama_item" value="{{$item->nama_item}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Stok</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="stok" placeholder="Stok" value="{{$item->stok}}">
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Deskripsi</label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="deskripsi">{{$item->deskripsi}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                <a class="btn btn-light btn-sm" href="/item">Cancel</a>
            </form>
        </div>
        </div>
    </div>
@endsection

