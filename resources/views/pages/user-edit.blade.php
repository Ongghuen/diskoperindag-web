@extends('layouts.mainlayout')

@section('title')
    Edit User
@endsection

@section('title-page')
    Edit User
@endsection

@section('tagline')
    Edit data user.
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Edit user</h4>
                <form class="forms-sample" action="/user-update/{{ $item->id }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input type="text" name="name" class="form-control" id="exampleInputUsername1"
                            placeholder="Name" value="{{ $item->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                            placeholder="Email" value="{{ $item->email }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">NIK</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="NIK"
                            placeholder="NIK" value="{{ $item->NIK }}">
                    </div>
                    <div class="form-group">
                        <label for="gender">Kepala Keluarga</label>
                        <select name="kepala_keluarga" id="kepala_keluarga" class="form-control">
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
                        <input type="text" class="form-control" id="exampleInputAlamat1" placeholder="Address"
                            value="{{ $item->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone1">No. Telepon</label>
                        <input type="text" class="form-control" id="exampleInputPhone1" placeholder="Phone"
                            value="{{ $item->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="{{ $item->gender }}">{{ $item->gender }}</option>
                            @if ($item->gender == 'L')
                                <option value="P">P</Option>
                            @else
                                <option value="L">L</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a class="btn btn-light" href="/user">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
