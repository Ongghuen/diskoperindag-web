<?php

namespace App\Exports;

use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SertifikatOneExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
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
                ->get();

        return $sertfikat;
    }

    public function map($sertfikat): array
    {
        $no_sertif = [];
        $penerima = [];
        $nik = [];
        ++$this->rowNumber;

        foreach($sertfikat->user as $item){
            array_push($no_sertif, $item->pivot->no_sertifikat);
        }

        foreach($sertfikat->user as $item){
            array_push($penerima, $item->name);
        }

        foreach($sertfikat->user as $item){
            array_push($nik, $item->NIK);
        }

        return [
            [
                $this->rowNumber,
                $sertfikat->nama,
                join(',', $no_sertif),
                join(',', $penerima),
                join(',', $nik),
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
            'Sertifikat',
            'Nomor Sertifikat',
            'Nama Penerima',
            'NIK',
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
