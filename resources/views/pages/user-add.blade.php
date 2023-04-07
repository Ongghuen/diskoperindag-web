@extends('layouts.mainlayout')

@section('title')
    Tambah User
@endsection

@section('title-page')
    Tambah User
@endsection

@section('tagline')
    Tambah data user.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form tambah user</h4>
                <form class="forms-sample" action="/user" method="POST" enctype="multipart/form-data">
                    @csrf
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
                        <label for="exampleInputUsername1">Nama</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name"
                            name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                            placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">NIK</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="NIK"
                            placeholder="NIK">
                    </div>
                    <div class="form-group">
                        <label for="kepala_keluarga">Kepala Keluarga</label>
                        <select name="kepala_keluarga" id="kepala_keluarga" class="form-control form-control-sm">
                            <option value="0">Tidak</option>
                            <option value="1">Iya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAddress1">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="exampleInputAddress1"
                            placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone1">No. Telepon</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputPhone1"
                            placeholder="No. Telepon">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control form-control-sm">
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal_lahir"
                            placeholder="Tanggal Lahir" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" id="exampleInputPhone1"
                            placeholder="Tempat Lahir">
                    </div>
                    <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                    <a class="btn btn-light btn-sm" href="/user">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
