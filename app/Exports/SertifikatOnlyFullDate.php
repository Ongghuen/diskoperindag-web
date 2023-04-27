<?php

namespace App\Exports;

use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SertifikatOnlyFullDate implements FromCollection, WithHeadings, WithMapping, WithTitle
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
        $sertfikat = Sertifikat::with('user.role')
            ->whereHas('user.role', function($query){
                $query
                ->where('name', 'User');
            })
            ->whereBetween('created_at', [$date1, $date2])
            ->get();

        return $sertfikat;
    }

    public function map($sertfikat): array
    {
        ++$this->rowNumber;

        return [
            [
                $this->rowNumber,
                $sertfikat->user->name,
                $sertfikat->user->NIK,
                $sertfikat->user->alamat,
                $sertfikat->no_sertifikat,
                $sertfikat->nama,
                $sertfikat->tanggal_terbit,
                $sertfikat->kadaluarsa_penyelenggara,
                $sertfikat->keterangan
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
            'Nomor Sertifikat',
            'Sertifikat',
            'Tanggal Terbit',
            'Tanggal Kadaluarsa',
            'Keterangan'
        ];
    }

    public function title(): string
    {
        return 'Sertifikat';
    }
}
