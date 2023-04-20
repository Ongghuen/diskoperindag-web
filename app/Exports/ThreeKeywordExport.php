<?php

namespace App\Exports;

use App\Exports\AlatThreeExport;
use App\Exports\UserThreeExport;
use App\Exports\PelatihanThreeExport;
use App\Exports\SertifikatThreeExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ThreeKeywordExport implements WithMultipleSheets
{
    protected $data1;
    protected $data2;
    protected $data3;

    function __construct($data1, $data2, $data3) {
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->data3 = $data3;
    }

    public function sheets(): array
    {
        return [
            'Induk Pengguna' => new UserThreeExport($this->data1, $this->data2, $this->data3),
            'Bantuan Alat' => new AlatThreeExport($this->data1, $this->data2, $this->data3),
            'Pelatihan' => new PelatihanThreeExport($this->data1, $this->data2, $this->data3),
            'Sertifikat' => new SertifikatThreeExport($this->data1, $this->data2, $this->data3)
        ];
    }
}
