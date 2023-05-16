<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class ApiBeritaController extends Controller
{
    public function index()
    {
        return response()->json(Berita::where('deleted_at', "=", null)->get());
    }

    public function indexSaved()
    {
        return response()->json(auth()->user()->berita()->get());
    }

    public function detail(string $id) {
        return response()->json(Berita::where('id', "=", $id)->first());
    }

    public function store(Request $request)
    {
        $saved = auth()->user()->berita()->get();
        for($i = 0; $i < count($saved); $i++){
            if($saved[$i]->id == $request->berita_id) return;
        }

        return auth()->user()->berita()->attach($request->berita_id);
    }

    public function destroy(string $id)
    {
        return auth()->user()->berita()->detach($id);
    }
}
