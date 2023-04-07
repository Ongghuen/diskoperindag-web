@extends('layouts.mainlayout')

@section('title')
    Tambah Item
@endsection

@section('title-page')
    Tambah Item Bantuan
@endsection

@section('tagline')
    Tambah item ke data bantuan.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form tambah Item Bantuan</h4>
                <form class="forms-sample" action="/bantuan-add-item" method="POST" enctype="multipart/form-data">
                    @csrf
                    <form class="forms-sample">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $pesan)
                                        <li>{{ $pesan }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="exampleInputUsername1" placeholder="Username"
                                value="{{ $bantuan->id }}" name="bantuan_id">
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleSelectGender">Nama Item</label>
                                <select class="form-control form-control-sm" id="exampleSelectGender" name="alat_id">
                                    @foreach ($itemList as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleInputUsername1">Kuantitas</label>
                                <input type="text" class="form-control" id="exampleInputUsername1"
                                    placeholder="Kuantitas" name="kuantitas">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                        <a class="btn btn-light btn-sm" href="/bantuan-detail/{{ $bantuan->id }}">Cancel</a>
                    </form>
            </div>
        </div>
    </div>
@endsection
