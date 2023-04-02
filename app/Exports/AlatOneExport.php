<?php

namespace App\Exports;

use App\Models\Bantuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class AlatOneExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $keyword;
    protected $rowNumber = 0;

    function __construct($data1) {
        $this->keyword = $data1;
    }
    
    public function collection()
    {
        $data = $this->keyword;
        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data.'%')
                    ->orwhereHas('user', function ($query) use($data){
                        $query
                        ->where('name', 'LIKE', '%'.$data.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data.'%');
                    });
                })
                ->whereHas('user.role', function($query) use($data){
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