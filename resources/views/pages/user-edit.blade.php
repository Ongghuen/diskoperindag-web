@extends('layouts.mainlayout')

@section('title')
    Edit Pengguna
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-master btn-sm mb-4" href="/user"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Form edit pengguna</h4>
                        <form class="forms-sample" action="/user-update/{{ $item->id }}" method="POST"
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
                                <label for="exampleInputUsername1">Nama</label>
                                <input type="text" name="name" class="form-control input-default"
                                    id="exampleInputUsername1" placeholder="Name" value="{{ $item->name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control input-default" id="exampleInputEmail1"
                                    name="email" placeholder="Email" value="{{ $item->email }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputNIK1">NIK</label>
                                <input type="number" class="form-control input-default" name="NIK"
                                    id="exampleInputNIK1" placeholder="NIK" value="{{ $item->NIK }}">
                            </div>
                            <div class="form-group">
                                <label for="kepala_keluarga">Kepala Keluarga</label>
                                <select name="kepala_keluarga" id="kepala_keluarga"
                                    class="form-control input-default">
                                    <option value="{{ $item->kepala_keluarga }}">
                                        {{ $item->kepala_keluarga == '0' ? 'Tidak' : 'Iya' }}
                                    </option>
                                    @if ($item->kepala_keluarga == '0')
                                        <option value="1">Iya</Option>
                                    @else
                                        <option value="0">Tidak</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputAlamat1">Alamat</label>
                                <input type="text" class="form-control input-default" name="alamat"
                                    id="exampleInputAlamat1" placeholder="Address" value="{{ $item->alamat }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputphone1">No Telepon</label>
                                <input type="number" class="form-control input-default" name="phone"
                                    id="exampleInputphone1" placeholder="No Telepon" value="{{ $item->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control input-default">
                                    <option value="{{ $item->gender }}">{{ $item->gender }}</option>
                                    @if ($item->gender == 'L')
                                        <option value="P">P</Option>
                                    @else
                                        <option value="L">L</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Tanggal Lahir</label>
                                <input type="date" class="form-control input-default" id="exampleInputEmail1"
                                    name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ $item->tanggal_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPhone1">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control input-default"
                                    id="exampleInputPhone1" placeholder="Tempat Lahir" value="{{ $item->tempat_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="jenis_usaha">Jenis Usaha</label>
                                <select name="jenis_usaha" id="jenis_usaha" onchange="showTextField()" class="form-control input-default form-control">
                                    @if ($item->jenis_usaha === 'Bakery')
                                        <option value="{{ $item->jenis_usaha }}">{{ $item->jenis_usaha }}</option>
                                        <option value="Mebel">Mebel</option>
                                        <option value="Tukang Jahit">Tukang Jahit</option>
                                        <option value="Lainnya">Lainnya</option>
                                    @elseif ($item->jenis_usaha === 'Mebel')
                                        <option value="{{ $item->jenis_usaha }}">{{ $item->jenis_usaha }}</option>
                                        <option value="Bakery">Bakery</option>
                                        <option value="Tukang Jahit">Tukang Jahit</option>
                                        <option value="Lainnya">Lainnya</option>
                                    @elseif ($item->jenis_usaha === 'Tukang Jahit')
                                        <option value="{{ $item->jenis_usaha }}">{{ $item->jenis_usaha }}</option>
                                        <option value="Bakery">Bakery</option>
                                        <option value="Mebel">Mebel</option>
                                        <option value="Lainnya">Lainnya</option>
                                    @else
                                        <option value="{{ $item->jenis_usaha }}">{{ $item->jenis_usaha }}</option>
                                        <option value="Bakery">Bakery</option>
                                        <option value="Mebel">Mebel</option>
                                        <option value="Tukang Jahit">Tukang Jahit</option>
                                        <option value="Lainnya">Lainnya</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group" id="usaha_lainnya" style="display: none;">
                                <label for="usaha_lainnya">Usaha Lainnya</label>
                                <input name="jenis_usaha_lainnya" id="usaha_lainnya" type="text" class="form-control input-default"
                                    placeholder="Input Usaha Lainnya" value="{{ old('jenis_usaha_lainnya') }}">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary me-2">Submit</button>
                            <a class="btn btn-light btn-sm" href="/user">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function showTextField() {
            var selectBox = document.getElementById("jenis_usaha");
            var otherJobDiv = document.getElementById("usaha_lainnya");
        
            if (selectBox.value === "Lainnya") {
                otherJobDiv.style.display = "block";
            } else {
                otherJobDiv.style.display = "none";
            }
        }
    </script>
@endsection