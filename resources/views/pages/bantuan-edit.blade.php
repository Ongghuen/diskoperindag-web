@extends('layouts.mainlayout')

@section('title')
    Edit Bantuan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-master btn-sm mb-4" href="/detail-user-bantuan/{{ $user->id }}"><i
                                class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Form edit bantuan</h4>
                        <form class="forms-sample" action="/bantuan-update/{{ $item->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <form class="forms-sample">
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
                                    <label for="exampleInputUsername1">Nama Bantuan</label>
                                    <input type="text" class="form-control input-master" id="exampleInputUsername1"
                                        placeholder="Nama Bantuan" name="nama_bantuan" value="{{ $item->nama_bantuan }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername2">Jenis Usaha</label>
                                    <input type="text" class="form-control input-master" id="exampleInputUsername2"
                                        placeholder="Jenis Usaha" name="jenis_usaha" value="{{ $item->jenis_usaha }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername3">Koordinator</label>
                                    <input type="text" class="form-control input-master" id="exampleInputUsername3"
                                        placeholder="Koordinator" name="koordinator" value="{{ $item->koordinator }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername4">Sumber Anggaran</label>
                                    <input type="text" class="form-control input-master" id="exampleInputUsername4"
                                        placeholder="Sumber Anggaran" name="sumber_anggaran"
                                        value="{{ $item->sumber_anggaran }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername3">Tanggal Pemberian</label>
                                    <input type="date" class="form-control input-rounded" id="exampleInputUsername3"
                                        placeholder="Tahun Pemberian" name="tahun_pemberian"
                                        value="{{ $item->tahun_pemberian }}">
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
