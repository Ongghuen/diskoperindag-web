<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiSuratController extends Controller
{
    public function index(){
        return response()->json(Surat::all());
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $image = null;
        if ($request->file){
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $fileName.'.'.$extension;

            $request->file->move(public_path('images/surat/'), $image);
        }

        $request['image'] = $image;
        $request['user_id'] = Auth::user()->id;
        $post = Surat::create($request->all());
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
