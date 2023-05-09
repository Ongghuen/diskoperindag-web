@extends('layouts.mainlayout')

@section('title')
    Add Sertifikat
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-4" href="/detail-user-bantuan/{{ $user->id }}"><i
                                class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Form tambah Sertifikat</h4>
                        <form class="forms-sample" action="/sertifikat" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group">
                                <input type="hidden" class="form-control input-rounded" id="exampleInputUsername1"
                                    placeholder="Username" value="{{ $user->id }}" name="user_id">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">No Sertifikat</label>
                                <input type="text" class="form-control input-rounded" id="exampleInputUsername1"
                                    placeholder="No Sertifikat" name="no_sertifikat">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nama</label>
                                <input type="text" class="form-control input-rounded" id="exampleInputUsername1"
                                    placeholder="Nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Tanggal Terbit</label>
                                <input type="date" class="form-control input-rounded" id="exampleInputEmail1"
                                    name="tanggal_terbit" placeholder="Tanggal Terbit">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Kadaluarsa Penyelenggara</label>
                                <input type="date" class="form-control input-rounded" id="exampleInputEmail1"
                                    name="kadaluarsa_penyelenggara" placeholder="Kadaluarsa Penyelenggara">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <textarea class="form-control input-rounded" id="exampleTextarea1" rows="4" name="keterangan"></textarea>
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
