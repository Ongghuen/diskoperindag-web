<?php

namespace App\Exports;

use App\Exports\AlatExport;
use App\Exports\UserExport;
use App\Exports\PelatihanExport;
use App\Exports\SertifikatExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class NoKeywordExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Induk Pengguna' => new UserExport(),
            'Bantuan Alat' => new AlatExport(),
            'Pelatihan' => new PelatihanExport(),
            'Sertifikat' => new SertifikatExport()
        ];
    }
}
