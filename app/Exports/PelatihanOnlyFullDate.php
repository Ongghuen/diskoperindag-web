<?php

namespace App\Exports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PelatihanOnlyFullDate implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
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
