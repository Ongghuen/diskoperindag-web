@extends('layouts.mainlayout')

@section('title')
    Add Item Bantuan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-4" href="/bantuan-detail/{{ $bantuan->id }}"><i
                                class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Form tambah Item Bantuan</h4>

                        <form class="forms-sample" action="/bantuan-add-item" method="POST" enctype="multipart/form-data">
                            @csrf
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
                                        placeholder="Username" value="{{ $bantuan->id }}" name="bantuan_id">
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleSelectGender">Nama Item</label>
                                        <select class="form-control input-rounded" id="exampleSelectGender" name="alat_id">
                                            @foreach ($itemList as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputUsername1">Kuantitas</label>
                                        <input type="text" class="form-control input-rounded" id="exampleInputUsername1"
                                            placeholder="Kuantitas" name="kuantitas">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                                <a class="btn btn-light btn-sm" href="/bantuan-detail/{{ $bantuan->id }}">Cancel</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
