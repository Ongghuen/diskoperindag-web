@extends('layouts.mainlayout')

@section('title')
    Edit Pelatihan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-4" href="/detail-user-bantuan/{{ $user->id }}"><i
                                class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Form Edit Pelatihan</h4>
                        <form class="forms-sample" action="/pelatihan-update/{{ $item->id }}" method="POST"
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
                                <input type="hidden" class="form-control input-rounded" id="exampleInputUsername1"
                                    placeholder="Username" value="{{ $user->id }}" name="user_id">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nama</label>
                                <input type="text" class="form-control input-rounded" id="exampleInputUsername1"
                                    placeholder="Nama" name="nama" value="{{ $item->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Penyelenggara</label>
                                <input type="text" class="form-control input-rounded" id="exampleInputEmail1"
                                    name="penyelenggara" placeholder="Penyelenggara" value="{{ $item->penyelenggara }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Tanggal Pelaksanaan</label>
                                <input type="date" class="form-control input-rounded" id="exampleInputEmail1"
                                    name="tanggal_pelaksanaan" placeholder="Tanggal Pelaksanaan"
                                    value="{{ $item->tanggal_pelaksanaan }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat</label>
                                <input type="text" class="form-control input-rounded" id="exampleInputEmail1"
                                    name="tempat" placeholder="Tempat" value="{{ $item->tempat }}">
                            </div>
                            <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                            <a class="btn btn-light btn-sm" href="/detail-user-bantuan/{{ $user->id }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
