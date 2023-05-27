<?php

namespace App\Exports;

use App\Models\Bantuan;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AlatOneExportDate implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
{
    protected $keyword1;
    protected $keyword2;
    protected $keyword3;
    protected $rowNumber = 0;

    function __construct($data1, $date1, $date2) {
        $this->keyword1 = $data1;
        $this->keyword2 = $date1;
        $this->keyword3 = $date2;
    }
    
    public function collection()
    {
        $data = $this->keyword1;
        $date1 = $this->keyword2;
        $date2 = $this->keyword3;
        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data.'%')
                    ->orwhereHas('user', function ($query) use($data){
                        $query
                        ->where('name', 'LIKE', '%'.$data.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data.'%');
                    });
                })
                ->whereBetween('tahun_pemberian', [$date1, $date2])
                ->whereHas('user.role', function($query) use($data){
                    $query
                    ->where('name', 'User');
                })
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
