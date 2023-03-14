<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BantuanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $bantuan = Bantuan::with(['user', 'itemBantuan'])
            ->where(function ($query) use ($keyword) {
                $query
                    ->where('nama_bantuan', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('jenis_usaha', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);

        return view('pages.bantuan', ['bantuanList' => $bantuan]);
    }
}
