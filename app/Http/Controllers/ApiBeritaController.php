<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class ApiBeritaController extends Controller
{
    //function untuk menampilkan semua berita di aplikasi mobile
    public function index() 
    {
        try {
            return response()->json(Berita::where('deleted_at', "=", null)->get());
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menampilkan berita'
            ], 500);
        }
    }

    //function untuk menampilkan berita yang disimpan di aplikasi mobile
    public function indexSaved() 
    {
        try {
            return response()->json(auth()->user()->berita()->get());
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menampilkan berita tersimpan'
            ], 500);
        }
    }

    //function untuk melihat detail berita di aplikasi mobile
    public function detail(string $id) 
    {
        try {
            return response()->json(Berita::where('id', "=", $id)->first());
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menampilkan detail berita'
            ], 500);
        }
    }

    //function untuk menyimpan berita di aplikasi mobile
    public function store(Request $request) 
    {
        try {
            $saved = auth()->user()->berita()->get();
            for($i = 0; $i < count($saved); $i++){
                if($saved[$i]->id == $request->berita_id) return;
            }
    
            auth()->user()->berita()->attach($request->berita_id);

            return response()->json([
                'message' => 'Berhasil menyimpan berita',
                'news' => auth()->user()->berita()->where('berita_id', $request->berita_id)->get()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menyimpan berita'
            ], 500);
        }
    }

    //function untuk mengapus berita yang tersimpan di aplikasi mobile
    public function destroy(string $id) 
    {
        try {
            auth()->user()->berita()->detach($id);

            return response()->json([
                'message' => 'Berhasil menghapus berita',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menghapus berita tersimpan'
            ], 500);
        }
    }
}
