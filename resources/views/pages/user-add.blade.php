@extends('layouts.mainlayout')

@section('title')
    Add User
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-4" href="/user"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Form tambah user</h4>
                        <form class="forms-sample" action="/user" method="POST" enctype="multipart/form-data">
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
                                <label for="">Name</label>
                                <input name="name" type="text" class="form-control input-rounded"
                                    placeholder="Input Name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input name="email" type="text" class="form-control input-rounded"
                                    placeholder="Input Email" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input name="password" type="password" class="form-control input-rounded"
                                    placeholder="Input Password" required>

                            </div>
                            <div class="form-group">
                                <label for="">Re-Password</label>
                                <input name="re_password" type="password" class="form-control input-rounded"
                                    placeholder="Input Password" required>
                            </div>
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input name="NIK" type="text" class="form-control input-rounded"
                                    placeholder="Input NIK" required>
                            </div>
                            <div class="form-group">
                                <label for="kepala_keluarga">Kepala Keluarga</label>
                                <select name="kepala_keluarga" id="kepala_keluarga" class="form-control input-rounded">
                                    <option value="0">Tidak</option>
                                    <option value="1">Iya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input name="alamat" type="text" class="form-control input-rounded"
                                    placeholder="Input Alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="">No Phone</label>
                                <input name="phone" type="text" class="form-control input-rounded"
                                    placeholder="Input Number Phone" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control input-rounded form-control">
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Tanggal Lahir</label>
                                <input type="date" class="form-control input-rounded" id="exampleInputEmail1"
                                    name="tanggal_lahir" placeholder="Tanggal Lahir" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input name="tempat_lahir" type="text" class="form-control input-rounded"
                                    placeholder="Input Tempat Lahir" required>
                            </div>
                            <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                            <a class="btn btn-light btn-sm" href="/user">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
