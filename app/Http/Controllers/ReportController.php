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
        $data = str_word_count($keyword, 1);

        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(10);

        if($keyword){
            if(array_key_exists('2', $data)){
                $data1 = $data[0];
                $data2 = $data[1];
                $data3 = $data[2];
            }elseif(array_key_exists('1', $data)){
                $data1 = $data[0];
                $data2 = $data[1];
            }elseif(array_key_exists('0', $data)){
                $data1 = $data[0];
            }

            if(isset($data3)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data1.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data1.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data1.'%')
                    ->orwhereHas('user', function ($query) use($data1){
                        $query
                        ->where('name', 'LIKE', '%'.$data1.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data1){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data1.'%');
                    });
                })
                ->where(function ($query) use($data2){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data2.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data2.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data2.'%')
                    ->orwhereHas('user', function ($query) use($data2){
                        $query
                        ->where('name', 'LIKE', '%'.$data2.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data2){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data2.'%');
                    });
                })
                ->where(function ($query) use($data3){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data3.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data3.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data3.'%')
                    ->orwhereHas('user', function ($query) use($data3){
                        $query
                        ->where('name', 'LIKE', '%'.$data3.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data3){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data3.'%');
                    });
                })
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(10);

                return view('pages.report', ['userList' => $bantuan]);
            }elseif(isset($data2)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data1.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data1.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data1.'%')
                    ->orwhereHas('user', function ($query) use($data1){
                        $query
                        ->where('name', 'LIKE', '%'.$data1.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data1){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data1.'%');
                    });
                })
                ->where(function ($query) use($data2){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data2.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data2.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data2.'%')
                    ->orwhereHas('user', function ($query) use($data2){
                        $query
                        ->where('name', 'LIKE', '%'.$data2.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data2){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data2.'%');
                    });
                })
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(10);

                return view('pages.report', ['userList' => $bantuan]);
            }elseif(isset($data1)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data1.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data1.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data1.'%')
                    ->orwhereHas('user', function ($query) use($data1){
                        $query
                        ->where('name', 'LIKE', '%'.$data1.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data1){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data1.'%');
                    });
                })
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(10);

                return view('pages.report', ['userList' => $bantuan]);
            }

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
