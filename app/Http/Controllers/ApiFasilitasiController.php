<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;

class ApiFasilitasiController extends Controller
{

    public function bantuan() //function untuk menampilkan bantuan yang didapat pengguna di aplikasi mobile
    {
        return response()->json(auth()->user()->bantuan()->get());
    }

    public function bantuanDetail($id) //function untuk melihat detail bantuan yang didapat pengguna di aplikasi mobile
    {
        $bantuan = Bantuan::with(['user', 'itemBantuan'])
            ->where('id', '=', $id)
            ->first();

        return response()->json($bantuan);
    }

    public function sertifikat() //function untuk melihat sertifikat yang didapat pengguna di aplikasi mobile
    {
        return response()->json(auth()->user()->sertifikat()->get());
    }

    public function pelatihan() //function untuk melihat pelatihan yang didapat pengguna di aplikasi mobile
    {
        return response()->json(auth()->user()->pelatihan()->get());
    }

}
