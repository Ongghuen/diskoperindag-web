<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($keyword){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$keyword.'%');
                })
                ->orwhereHas('user', function ($query) use($keyword){
                    $query
                    ->where('name', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('NIK', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('alamat', 'LIKE', '%'.$keyword.'%');
                })
                ->whereHas('user.role', function($query) use($keyword){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(10);

        return view('pages.report', ['userList' => $bantuan]);
    }
}
