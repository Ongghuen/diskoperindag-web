<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Exports\DataExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($keyword){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$keyword.'%');
                })
                ->orwhereHas('user', function ($query) use($keyword){
                    $query
                    ->where('name', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('NIK', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('alamat', 'LIKE', '%'.$keyword.'%');
                })
                ->orWherehas('itemBantuan', function ($query) use($keyword){
                    $query
                    ->where('nama_item', 'LIKE', '%'.$keyword.'%');
                })
                ->whereHas('user.role', function($query) use($keyword){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(10);

        if($keyword){
            return view('pages.report', ['userList' => $bantuan, 'data' => $keyword]);
        }else{
            return view('pages.report', ['userList' => $bantuan]);
        }
    }

    public function export(Request $request)
    {
        $data = $request->data;
        return Excel::download(new DataExport($data), 'laporan ' . date('Y-m-d') . '.xlsx');
    }
}
