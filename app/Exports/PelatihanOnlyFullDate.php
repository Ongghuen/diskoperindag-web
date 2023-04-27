<?php

namespace App\Exports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelatihanOnlyFullDate implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $keyword2;
    protected $keyword3;
    protected $rowNumber = 0;

    function __construct($date1, $date2) {
        $this->keyword2 = $date1;
        $this->keyword3 = $date2;
    }
    
    public function collection()
    {
        $date1 = $this->keyword2;
        $date2 = $this->keyword3;
        $pelatihan = Pelatihan::with('user.role')
            ->whereHas('user.role', function($query){
                $query
                ->where('name', 'User');
            })
            ->whereBetween('created_at', [$date1, $date2])
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
