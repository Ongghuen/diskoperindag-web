<?php

namespace App\Http\Controllers;

use App\Models\Berita;


class ApiBeritaController extends Controller
{
    public function index()
    {
        return response()->json(Berita::all());
    }
}
