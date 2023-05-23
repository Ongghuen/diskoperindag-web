<?php

namespace App\Exports;

use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SertifikatTwoExportDate implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEsvents
{
    protected $keyword1;
    protected $keyword2;
    protected $keyword3;
    protected $keyword4;
    protected $rowNumber = 0;

    function __construct($data1, $data2, $date1, $date2) {
        $this->keyword1 = $data1;
        $this->keyword2 = $data2;
        $this->keyword3 = $date1;
        $this->keyword4 = $date2;
    }

    public function collection()
    {
        $data1 = $this->keyword1;
        $data2 = $this->keyword2;
        $date1 = $this->keyword3;
        $date2 = $this->keyword4;
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
                ->where(function ($query) use($data2){
                    $query
                    ->where('nama', 'LIKE', '%'.$data2.'%')
                    ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                    ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                    ->orwhereHas('user', function ($query) use($data2){
                        $query
                        ->where('name', 'LIKE', '%'.$data2.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                    });
                })
                ->whereBetween('created_at', [$date1, $date2])
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
