<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bantuan;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Exports\OnlyFullDate;
use App\Exports\NoKeywordExport;
use App\Exports\OneKeywordExport;
use App\Exports\TwoKeywordExport;
use App\Exports\ThreeKeywordExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OneKeywordExportDate;
use App\Exports\TwoKeywordExportDate;
use App\Exports\ThreeKeywordExportDate;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $date1 = $request->date1;
        $date2 = $request->date2;
        $today = Carbon::today();
        $now = $today->toDateString();
        $data = preg_split('/\W+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);

        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(5);

        $pelatihan = Pelatihan::with('user.role')
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(5);

        $sertfikat = Sertifikat::with('user.role')
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(5);

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

            if(isset($data3) && ($date1 != null) && ($date2 != null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
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
                ->whereBetween('tahun_pemberian', [$date1, $date2])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->where(function ($query) use($data3){
                        $query
                        ->where('nama', 'LIKE', '%'.$data3.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data3.'%')
                        ->orwhereHas('user', function ($query) use($data3){
                            $query
                            ->where('name', 'LIKE', '%'.$data3.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->where(function ($query) use($data3){
                        $query
                        ->where('nama', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data3.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data3.'%')
                        ->orwhereHas('user', function ($query) use($data3){
                            $query
                            ->where('name', 'LIKE', '%'.$data3.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword, 'date1' => $date1, 'date2' => $date2]);
            }elseif(isset($data3) && ($date1 == null) && ($date2 != null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
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
                ->whereBetween('tahun_pemberian', [$now, $date2])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->where(function ($query) use($data3){
                        $query
                        ->where('nama', 'LIKE', '%'.$data3.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data3.'%')
                        ->orwhereHas('user', function ($query) use($data3){
                            $query
                            ->where('name', 'LIKE', '%'.$data3.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                        });
                    })
                    ->whereBetween('created_at', [$now, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->where(function ($query) use($data3){
                        $query
                        ->where('nama', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data3.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data3.'%')
                        ->orwhereHas('user', function ($query) use($data3){
                            $query
                            ->where('name', 'LIKE', '%'.$data3.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                        });
                    })
                    ->whereBetween('created_at', [$now, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword, 'now' => $now, 'date2' => $date2]);
            }elseif(isset($data3) && ($date1 != null) && ($date2 == null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
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
                ->whereBetween('tahun_pemberian', [$date1, $now])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->where(function ($query) use($data3){
                        $query
                        ->where('nama', 'LIKE', '%'.$data3.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data3.'%')
                        ->orwhereHas('user', function ($query) use($data3){
                            $query
                            ->where('name', 'LIKE', '%'.$data3.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1, $now])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->where(function ($query) use($data3){
                        $query
                        ->where('nama', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data3.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data3.'%')
                        ->orwhereHas('user', function ($query) use($data3){
                            $query
                            ->where('name', 'LIKE', '%'.$data3.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1, $now])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword, 'date1' => $date1, 'now' => $now]);
            }if(isset($data3) && ($date1 == null) && ($date2 == null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
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
                ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->where(function ($query) use($data3){
                        $query
                        ->where('nama', 'LIKE', '%'.$data3.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data3.'%')
                        ->orwhereHas('user', function ($query) use($data3){
                            $query
                            ->where('name', 'LIKE', '%'.$data3.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                        });
                    })
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->where(function ($query) use($data3){
                        $query
                        ->where('nama', 'LIKE', '%'.$data3.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data3.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data3.'%')
                        ->orwhereHas('user', function ($query) use($data3){
                            $query
                            ->where('name', 'LIKE', '%'.$data3.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                        });
                    })
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword]);
            }elseif(isset($data2) && ($date1 != null) && ($date2 != null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
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
                ->whereBetween('tahun_pemberian', [$date1,$date2])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1,$date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1,$date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword, 'date1' => $date1, 'date2' => $date2]);
            }elseif(isset($data2) && ($date1 == null) && ($date2 != null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
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
                ->whereBetween('tahun_pemberian', [$now,$date2])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->whereBetween('created_at', [$now,$date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->whereBetween('created_at', [$now,$date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword, 'now' => $now, 'date2' => $date2]);
            }elseif(isset($data2) && ($date1 != null) && ($date2 == null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
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
                ->whereBetween('tahun_pemberian', [$date1,$now])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1,$now])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1,$now])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword, 'date1' => $date1, 'now' => $now]);
            }elseif(isset($data2) && ($date1 == null) && ($date2 == null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
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
                ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->where(function ($query) use($data2){
                        $query
                        ->where('nama', 'LIKE', '%'.$data2.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                        ->orwhereHas('user', function ($query) use($data2){
                            $query
                            ->where('name', 'LIKE', '%'.$data2.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                        });
                    })
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword]);
            }elseif(isset($data1) && ($date1 != null) && ($date2 != null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                    ->where(function ($query) use($data1){
                        $query
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
                    ->whereBetween('tahun_pemberian', [$date1, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword, 'date1' => $date1, 'date2' => $date2]);
            }elseif(isset($data1) && ($date1 == null) && ($date2 != null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                    ->where(function ($query) use($data1){
                        $query
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
                    ->whereBetween('tahun_pemberian', [$now, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->whereBetween('created_at', [$now, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->whereBetween('created_at', [$now, $date2])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword, 'now' => $now, 'date2' => $date2]);
            }elseif(isset($data1) && ($date1 != null) && ($date2 == null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                    ->where(function ($query) use($data1){
                        $query
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
                    ->whereBetween('tahun_pemberian', [$date1, $now])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1, $now])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->whereBetween('created_at', [$date1, $now])
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword, 'date1' => $date1, 'now' => $now]);
            }elseif(isset($data1) && ($date1 == null) && ($date2 == null)){
                $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                    ->where(function ($query) use($data1){
                        $query
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
                    ->paginate(5);

                $pelatihan = Pelatihan::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                $sertfikat = Sertifikat::with('user.role')
                    ->where(function ($query) use($data1){
                        $query
                        ->where('nama', 'LIKE', '%'.$data1.'%')
                        ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                        ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                        ->orwhereHas('user', function ($query) use($data1){
                            $query
                            ->where('name', 'LIKE', '%'.$data1.'%')
                            ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                            ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                        });
                    })
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->paginate(5);

                return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'keyword' => $keyword]);
            }

        }elseif(empty($keyword) && ($date1 != null) && ($date2 != null)){
            $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->whereBetween('tahun_pemberian', [$date1, $date2])
                ->paginate(5);

            $pelatihan = Pelatihan::with('user.role')
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->whereBetween('created_at', [$date1, $date2])
                ->paginate(5);

            $sertfikat = Sertifikat::with('user.role')
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->whereBetween('created_at', [$date1, $date2])
                ->paginate(5);

            return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'date1' => $date1, 'date2' => $date2]);
        }elseif(empty($keyword) && ($date1 == null) && ($date2 != null)){
            $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->whereBetween('tahun_pemberian', [$now, $date2])
                ->paginate(5);

            $pelatihan = Pelatihan::with('user.role')
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->whereBetween('created_at', [$now, $date2])
                ->paginate(5);

            $sertfikat = Sertifikat::with('user.role')
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->whereBetween('created_at', [$now, $date2])
                ->paginate(5);

            return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'now' => $now, 'date2' => $date2]);
        }elseif(empty($keyword) && ($date1 != null) && ($date2 == null)){
            $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->whereBetween('tahun_pemberian', [$date1, $now])
                ->paginate(5);

            $pelatihan = Pelatihan::with('user.role')
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->whereBetween('created_at', [$date1, $now])
                    ->paginate(5);

            $sertfikat = Sertifikat::with('user.role')
                    ->whereHas('user.role', function($query){
                        $query
                        ->where('name', 'User');
                    })
                    ->whereBetween('created_at', [$date1, $now])
                    ->paginate(5);

            return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat, 'date1' => $date1, 'now' => $now]);
        }elseif(empty($keyword)){
            return view('pages.report', ['userList' => $bantuan, 'pelatihanList' => $pelatihan, 'sertifList' => $sertfikat]);
        }
    }

    public function export(Request $request)
    {
        $keyword = $request->data;
        $date1 = $request->date1;
        $date2 = $request->date2;
        $today = Carbon::today();
        $now = $today->toDateString();
        $data = preg_split('/\W+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);

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

            if(isset($data3) && ($date1 != null) && ($date2 != null)){
                return Excel::download(new ThreeKeywordExportDate($data1, $data2, $data3, $date1, $date2), 'laporan ' . date('Y-m-d') . '.xlsx');
            }elseif(isset($data3)){
                return Excel::download(new ThreeKeywordExport($data1, $data2, $data3), 'laporan ' . date('Y-m-d') . '.xlsx');
            }elseif(isset($data2) && ($date1 != null) && ($date2 != null)){
                return Excel::download(new TwoKeywordExportDate($data1, $data2, $date1, $date2), 'laporan ' . date('Y-m-d') . '.xlsx');
            }elseif(isset($data2)){
                return Excel::download(new TwoKeywordExport($data1, $data2), 'laporan ' . date('Y-m-d') . '.xlsx');
            }elseif(isset($data1) && ($date1 != null) && ($date2 != null)){
                return Excel::download(new OneKeywordExportDate($data1, $date1, $date2), 'laporan ' . date('Y-m-d') . '.xlsx');
            }elseif(isset($data1)){
                return Excel::download(new OneKeywordExport($data1), 'laporan ' . date('Y-m-d') . '.xlsx');
            }
        }elseif(empty($keyword) && ($date1 != null) && ($date2 != null)){
            return Excel::download(new OnlyFullDate($date1, $date2), 'laporan ' . date('Y-m-d') . '.xlsx');
        }elseif(empty($keyword)){
            return Excel::download(new NoKeywordExport(), 'laporan ' . date('Y-m-d') . '.xlsx');
        }
    }
}
