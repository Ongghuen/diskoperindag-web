<?php

namespace App\Exports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PelatihanTwoExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
{
    protected $keyword1;
    protected $keyword2;
    protected $rowNumber = 0;

    function __construct($data1, $data2) {
        $this->keyword1 = $data1;
        $this->keyword2 = $data2;
    }
    
    public function collection()
    {
        $data1 = $this->keyword1;
        $data2 = $this->keyword2;
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
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->get();
        
        return $pelatihan;
    }

    public function map($pelatihan): array
    {
        $peserta = [];
        $nik = [];
        ++$this->rowNumber;

        foreach($pelatihan->user as $item){
            array_push($peserta, $item->name);
        }

        foreach($pelatihan->user as $item){
            array_push($nik, $item->NIK);
        }

        return [
            [
                $this->rowNumber,
                $pelatihan->nama,
                join(',', $peserta),
                join(',', $nik),
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
            'Nama Pelatihan',
            'Nama Penerima',
            'NIK',
            'Penyelenggara',
            'Tanggal Pelaksanaan',
            'Tempat'
        ];
    }

    public function title(): string
    {
        return 'Pelatihan';
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
