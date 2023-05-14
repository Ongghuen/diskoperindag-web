<?php

namespace App\Exports;

use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SertifikatThreeExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
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
                ->where(function ($query) use($data2){
                    $query
                    ->where('no_sertifikat', 'LIKE', '%'.$data2.'%')
                    ->orWhere('nama', 'LIKE', '%'.$data2.'%')
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
                    ->where('no_sertifikat', 'LIKE', '%'.$data3.'%')
                    ->orWhere('nama', 'LIKE', '%'.$data3.'%')
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->autoSize();
            },
        ];
    }
}
