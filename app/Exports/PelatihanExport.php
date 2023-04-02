<?php

namespace App\Exports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelatihanExport implements  FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $rowNumber = 0;

    public function collection()
    {
        $pelatihan = Pelatihan::with('user.role')
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
