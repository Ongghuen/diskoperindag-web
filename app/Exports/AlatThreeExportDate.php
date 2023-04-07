<?php

namespace App\Exports;

use App\Models\Bantuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class AlatThreeExportDate implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $keyword1;
    protected $keyword2;
    protected $keyword3;
    protected $keyword4;
    protected $keyword5;
    protected $rowNumber = 0;

    function __construct($data1, $data2, $data3, $date1, $date2) {
        $this->keyword1 = $data1;
        $this->keyword2 = $data2;
        $this->keyword3 = $data3;
        $this->keyword4 = $date1;
        $this->keyword5 = $date2;
    }
    
    public function collection()
    {
        $data1 = $this->keyword1;
        $data2 = $this->keyword2;
        $data3 = $this->keyword3;
        $date1 = $this->keyword4;
        $date2 = $this->keyword5;
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
                ->whereBetween('tahun_pemberian', [$date1, $date2])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->get();

        return $bantuan;
    }

    public function map($bantuan): array
    {
        $qty = [];
        $alat = [];
        ++$this->rowNumber;

        foreach($bantuan->itemBantuan as $item){
            array_push($qty, $item->pivot->kuantitas);
        }

        foreach($bantuan->itemBantuan as $item){
            array_push($alat, $item->nama_item);
        }

        return [
            [
                $this->rowNumber,
                $bantuan->user->name,
                $bantuan->user->NIK,
                $bantuan->user->alamat,
                $bantuan->nama_bantuan,
                join(',', $alat),
                join(',', $qty),
                $bantuan->tahun_pemberian,
                $bantuan->jenis_usaha
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama Penerima',
            'NIK',
            'Alamat',
            'Bantuan',
            'Alat',
            'Jumlah',
            'Tahun Pemberian',
            'Jenis Usaha'
        ];
    }

    public function title(): string
    {
        return 'Bantuan Alat';
    }
}
