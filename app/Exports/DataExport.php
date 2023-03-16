<?php

namespace App\Exports;

use App\Models\Bantuan;
use App\Models\Role;
use App\Models\User;
use App\Models\ItemBantuan;
use App\Models\BantuanItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class DataExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->whereHas('user.role', function($query){
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
        $i = 1;

        foreach($bantuan->itemBantuan as $item){
            array_push($qty, $item->pivot->kuantitas);
        }

        foreach($bantuan->itemBantuan as $item){
            array_push($alat, $item->nama_item);
        }

        return [
            [
                $bantuan->id,
                $bantuan->user->name,
                $bantuan->user->NIK,
                $bantuan->user->alamat,
                $bantuan->nama_bantuan,
                join(',', $alat),
                join(',', $qty),
                $bantuan->tahun_pemberian,
                $bantuan->jenis_usaha
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'Bantuan Id.',
            'Nama Penerima',
            'NIK',
            'Alamat',
            'Bantuan',
            'Alat',
            'Jumlah',
            'Tahun Pemberian',
            'Jenis Usaha'
        ];
    }

    public function title(): string
    {
        return 'Data Bantuan';
    }
}
