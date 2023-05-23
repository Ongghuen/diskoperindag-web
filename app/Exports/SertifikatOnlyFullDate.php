<?php

namespace App\Exports;

use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SertifikatOnlyFullDate implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
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
