<?php

namespace App\Exports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelatihanOneExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $keyword;
    protected $rowNumber = 0;

    function __construct($data1) {
        $this->keyword = $data1;
    }
    
    public function collection()
    {
        $data1 = $this->keyword;
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
                ->get();
        
        return $pelatihan;
    }

    public function map($pelatihan): array
    {
        ++$this->rowNumber;

        return [
            [
                $this->rowNumber,
                $pelatihan->user->name,
                $pelatihan->user->NIK,
                $pelatihan->user->alamat,
                $pelatihan->nama,
                $pelatihan->penyelenggara,
                $pelatihan->tanggal_pelaksanaan,
                $pelatihan->tempat
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
            'Pelatihan',
            'Penyelenggara',
            'Tanggal Pelaksanaan',
            'Tempat'
        ];
    }

    public function title(): string
    {
        return 'Pelatihan';
    }
}
