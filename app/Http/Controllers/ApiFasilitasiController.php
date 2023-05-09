<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;

class ApiFasilitasiController extends Controller
{

    public function bantuan()
    {
        return response()->json(auth()->user()->bantuan()->get());
    }

    public function bantuanDetail($id)
    {
        $bantuan = Bantuan::with(['user', 'itemBantuan'])
            ->where('id', '=', $id)
            ->first();

        return response()->json($bantuan);
    }

    public function sertifikat()
    {
        return response()->json(auth()->user()->sertifikat()->get());
    }

    public function pelatihan()
    {
        return response()->json(auth()->user()->pelatihan()->get());
    }

}
