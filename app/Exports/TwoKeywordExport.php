<?php

namespace App\Exports;

use App\Exports\AlatTwoExport;
use App\Exports\PelatihanTwoExport;
use App\Exports\SertifikatTwoExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TwoKeywordExport implements WithMultipleSheets
{
    protected $data1;
    protected $data2;

    function __construct($data1, $data2) {
        $this->data1 = $data1;
        $this->data2 = $data2;
    }

    public function sheets(): array
    {
        return [
            'Bantuan Alat' => new AlatTwoExport($this->data1, $this->data2),
            'Pelatihan' => new PelatihanTwoExport($this->data1, $this->data2),
            'Sertifikat' => new SertifikatTwoExport($this->data1, $this->data2)
        ];
    }
}
