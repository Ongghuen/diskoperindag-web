@extends('layouts.mainlayout')

@section('title')
    Tambah Item
@endsection

@section('title-page')
    Tambah Item Pelatihan
@endsection

@section('tagline')
    Tambah item ke data Pelatihan.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form tambah Item Pelatihan</h4>
                <form class="forms-sample" action="/pelatihan-add-item" method="POST" enctype="multipart/form-data">
                    @csrf
                    <form class="forms-sample">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="exampleInputUsername1" placeholder="Username"
                                value="{{ $bantuan->id }}" name="bantuan_id">
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleSelectGender">Nama Item</label>
                                <select class="form-control form-control-sm" id="exampleSelectGender" name="item_id">
                                    @foreach ($PelatihanList as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                        <a class="btn btn-light btn-sm" href="{{ url()->previous() }}">Cancel</a>
                    </form>
            </div>
        </div>
    </div>
@endsection
