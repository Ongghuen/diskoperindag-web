@extends('layouts.mainlayout')

@section('title')
    Edit Pelatihan
@endsection

@section('title-page')
    Edit Pelatihan
@endsection

@section('tagline')
    Edit Pelatihan
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Edit Pelatihan</h4>
                <form class="forms-sample" action="/sertifikat-update/{{ $item->id }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                            value="{{ $user->id }}" name="user_id">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">No Sertifikat</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="No Sertifikat"
                            name="no_sertifikat" value="{{ $item->no_sertifikat }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nama"
                            name="nama" value="{{ $item->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal_terbit"
                            placeholder="Tanggal Terbit" value="{{ $item->tanggal_terbit }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Kadaluarsa Penyelenggara</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="kadaluarsa_penyelenggara"
                            placeholder="Kadaluarsa Penyelenggara" value="{{ $item->kadaluarsa_penyelenggara }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="keterangan">{{ $item->keterangan }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                    <a class="btn btn-light btn-sm" href="/detail-user-bantuan/{{ $user->id }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
