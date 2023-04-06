@extends('layouts.mainlayout')

@section('title')
    Edit Bantuan
@endsection

@section('title-page')
    Edit Bantuan
@endsection

@section('tagline')
    Edit bantuan ke data user.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form edit bantuan</h4>
            <form class="forms-sample" action="/bantuan-update/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <form class="forms-sample">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="exampleInputUsername1" placeholder="Username" value="{{$user->id}}" name="user_id">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Nama Bantuan</label>
                    <input type="text" class="form-control" id="exampleInputUsername1"
                        placeholder="Nama Bantuan" name="nama_bantuan" value="{{$item->nama_bantuan}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername2">Jenis Usaha</label>
                    <input type="text" class="form-control" id="exampleInputUsername2"
                        placeholder="Jenis Usaha" name="jenis_usaha" value="{{$item->jenis_usaha}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername3">Koordinator</label>
                    <input type="text" class="form-control" id="exampleInputUsername3"
                        placeholder="Koordinator" name="koordinator" value="{{$item->koordinator}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername4">Sumber Anggaran</label>
                    <input type="text" class="form-control" id="exampleInputUsername4"
                        placeholder="Sumber Anggaran" name="sumber_anggaran" value="{{$item->sumber_anggaran}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername3">Tanggal Pemberian</label>
                    <input type="date" class="form-control" id="exampleInputUsername3"
                        placeholder="Tahun Pemberian" name="tahun_pemberian" value="{{$item->tahun_pemberian}}">
                </div>
                <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                <a class="btn btn-light btn-sm" href="{{ url()->previous() }}">Cancel</a>
            </form>
        </div>
        </div>
    </div>
@endsection

