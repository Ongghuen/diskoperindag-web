<?php

namespace App\Exports;

use App\Models\Bantuan;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AlatOnlyFullDate implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
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
        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
            ->whereHas('user.role', function($query){
                $query
                ->where('name', 'User');
            })
            ->whereBetween('tahun_pemberian', [$date1, $date2])
            ->get();

        return $bantuan;
    }

    public function map($bantuan): array
    {
        $qty = [];
        $alat = [];
        ++$this->rowNumber;

        foreach($bantuan->itemBantuan as $item){
            array_push($qty, $item->pivot->kuantitas);
        }

        foreach($bantuan->itemBantuan as $item){
            array_push($alat, $item->nama_item);
        }

        return [
            [
                $this->rowNumber,
                $bantuan->user->name,
                $bantuan->user->NIK,
                $bantuan->user->alamat,
                $bantuan->nama_bantuan,
                join(',', $alat),
                join(',', $qty),
                $bantuan->koordinator,
                $bantuan->sumber_anggaran,
                $bantuan->tahun_pemberian,
                $bantuan->user->jenis_usaha
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
            'Bantuan',
            'Alat',
            'Jumlah',
            'Koordinator',
            'Sumber Anggaran',
            'Tahun Pemberian',
            'Jenis Usaha'
        ];
    }

    public function title(): string
    {
        return 'Bantuan Alat';
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
