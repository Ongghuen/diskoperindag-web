<?php

namespace App\Exports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelatihanThreeExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $keyword1;
    protected $keyword2;
    protected $keyword3;
    protected $rowNumber = 0;

    function __construct($data1, $data2, $data3) {
        $this->keyword1 = $data1;
        $this->keyword2 = $data2;
        $this->keyword3 = $data3;
    }
    
    public function collection()
    {
        $data1 = $this->keyword1;
        $data2 = $this->keyword2;
        $data3 = $this->keyword3;
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
