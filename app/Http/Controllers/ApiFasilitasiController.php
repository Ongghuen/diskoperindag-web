<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;

class ApiFasilitasiController extends Controller
{
    //function untuk menampilkan bantuan yang didapat pengguna di aplikasi mobile
    public function bantuan() 
    {
        try {
            return response()->json(auth()->user()->bantuan()->get());
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menampilkan bantuan'
            ], 500);
        }
    }

    //function untuk melihat detail bantuan yang didapat pengguna di aplikasi mobile
    public function bantuanDetail($id)
    {
        try {
            $bantuan = Bantuan::with(['user', 'itemBantuan'])
                ->where('id', '=', $id)
                ->first();
    
            return response()->json($bantuan);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menampilkan detail bantuan'
            ], 500);
        }
    }

    //function untuk melihat sertifikat yang didapat pengguna di aplikasi mobile
    public function sertifikat() 
    {
        try {
            return response()->json(auth()->user()->sertifikat()->get());
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menampilkan sertifikat'
            ], 500);
        }
    }

    //function untuk melihat pelatihan yang didapat pengguna di aplikasi mobile
    public function pelatihan() 
    {
        try {
            return response()->json(auth()->user()->pelatihan()->get());
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menampilkan pelatihan'
            ], 500);
        }
    }

}
