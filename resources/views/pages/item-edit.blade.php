@extends('layouts.mainlayout')

@section('title')
    Edit Alat
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-master btn-sm mb-4" href="/alatitem"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Form edit alat bantuan</h4>
                        <form class="forms-sample" action="/item-update/{{ $item->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span>
                                    </button>


                                    <?php
                                    
                                    $nomer = 1;
                                    
                                    ?>

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $nomer++ }}. {{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nama Item</label>
                                <input type="text" class="form-control input-default" id="exampleInputUsername1"
                                    placeholder="Nama Item" name="nama_item" value="{{ $item->nama_item }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Deskripsi</label>
                                <textarea class="form-control input-default" id="exampleTextarea1" rows="4" name="deskripsi">{{ $item->deskripsi }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                            <a class="btn btn-light btn-sm" href="/alatitem">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
