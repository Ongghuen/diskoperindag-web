@extends('layouts.mainlayout')

@section('title')
    Tambah Bantuan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-master btn-sm mb-4" href="/detail-user-bantuan/{{ $user->id }}"><i
                                class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Form tambah bantuan</h4>
                        <form class="forms-sample" action="/user-add-bantuan" method="POST" enctype="multipart/form-data">
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
                                    <input type="hidden" class="form-control input-default" id="exampleInputUsername1"
                                        placeholder="Username" value="{{ $user->id }}" name="user_id">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nama Bantuan</label>
                                    <input type="text" class="form-control input-default" id="exampleInputUsername1"
                                        placeholder="Nama Bantuan" name="nama_bantuan" value="{{ old('nama_bantuan') }}">
                                </div>
                                <div class="form-group">
                                    <label for="lembaga_koordinator">Lembaga Koordinator</label>
                                    <select name="lembaga_koordinator" id="lembaga_koordinator" onchange="showTextField1()" class="form-control input-default form-control">
                                        <option value="PDI Perjuangan">PDI Perjuangan</option>
                                        <option value="Golkar">Golkar</option>
                                        <option value="Gerindra">Gerindra</option>
                                        <option value="Partai Kebangkitan Bangsa (PKB)">Partai Kebangkitan Bangsa (PKB)</option>
                                        <option value="Demokrat">Demokrat</option>
                                        <option value="Partai Keadilan Sejahtera (PKS)">Partai Keadilan Sejahtera (PKS)</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group" id="koordinator_lainnya" style="display: none;">
                                    <label for="lainnya">Lembaga Lainnya</label>
                                    <input name="koordinator_lainnya" id="lainnya" type="text" class="form-control input-default"
                                        placeholder="Input Koordinator Lainnya" value="{{ old('koordinator_lainnya') }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername4">Nama Koordinator</label>
                                    <input type="text" class="form-control input-default" id="exampleInputUsername4"
                                        placeholder="Nama Koordinator" name="nama_koordinator" value="{{ old('nama_koordinator') }}">
                                </div>
                                <div class="form-group">
                                    <label for="sumber_anggaran">Sumber Anggaran</label>
                                    <select name="sumber_anggaran" id="sumber_anggaran" onchange="showTextField2()" class="form-control input-default form-control">
                                        <option value="DAU">DAU</option>
                                        <option value="DAK">DAK</option>
                                        <option value="DBHCHT">DBHCHT</option>
                                        <option value="BK">BK</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group" id="anggaran_lainnya" style="display: none;">
                                    <label for="lainnya">Anggaran Lainnya</label>
                                    <input name="anggaran_lainnya" id="lainnya" type="text" class="form-control input-default"
                                        placeholder="Input Anggaran Lainnya" value="{{ old('anggaran_lainnya') }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername3">Tanggal Pemberian</label>
                                    <input type="date" class="form-control input-default" id="exampleInputUsername3"
                                        placeholder="Tahun Pemberian" name="tahun_pemberian" value="{{ old('tahun_pemberian') }}">
                                </div>
                                <button type="submit" class="btn btn-primary me-2 btn-sm">Submit</button>
                                <a class="btn btn-light btn-sm" href="/detail-user-bantuan/{{ $user->id }}">Cancel</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        function showTextField1() {
            var selectBox = document.getElementById("lembaga_koordinator");
            var otherJobDiv = document.getElementById("koordinator_lainnya");
        
            if (selectBox.value === "Lainnya") {
                otherJobDiv.style.display = "block";
            } else {
                otherJobDiv.style.display = "none";
            }
        }

        function showTextField2() {
            var selectBox = document.getElementById("sumber_anggaran");
            var otherJobDiv = document.getElementById("anggaran_lainnya");
        
            if (selectBox.value === "Lainnya") {
                otherJobDiv.style.display = "block";
            } else {
                otherJobDiv.style.display = "none";
            }
        }
    </script>
@endsection

