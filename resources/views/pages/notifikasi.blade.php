@extends('layouts.mainlayout')

@section('title')
Beri Notifikasi
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-master btn-sm mb-4" href="/berita"><i class="fa fa-arrow-left"></i></a>
                    <h4 class="card-title">Form Notifikasi</h4>
                    <form class="forms-sample" action="/notifikasi/add" method="POST" enctype="multipart/form-data">
                        @csrf
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

                        <select class="select2 form-control" name="token">
                            <option value="Semua" selected>-- Semua --</option>
                            @foreach ($user as $data)
                            <option value="{{ $data->fcm_token }}">{{ $data->name }}
                            </option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input type="text" class="form-control input-default" id="exampleInputEmail1" name="judul"
                                placeholder="Enter Judul" value="{{ old('judul') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Deskripsi</label>
                            <textarea class="form-control input-default" id="exampleTextarea1" rows="4" name="body">{{
                                old('body') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                        <a class="btn btn-light btn-sm" href="/berita">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
