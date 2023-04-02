<?php

namespace App\Exports;

use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SertifikatOneExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $keyword;
    protected $rowNumber = 0;

    function __construct($data1) {
        $this->keyword = $data1;
    }

    public function collection()
    {
        $data1 = $this->keyword;
        $sertfikat = Sertifikat::with('user.role')
                ->where(function ($query) use($data1){
                    $query
                    ->where('no_sertifikat', 'LIKE', '%'.$data1.'%')
                    ->orWhere('nama', 'LIKE', '%'.$data1.'%')
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
