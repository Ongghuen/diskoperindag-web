<?php

namespace App\Exports;

use App\Exports\AlatOneExport;
use App\Exports\PelatihanOneExport;
use App\Exports\SertifikatOneExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OneKeywordExportDate implements WithMultipleSheets
{
    protected $data1;
    protected $date1;
    protected $date2;

    function __construct($data1, $date1, $date2) {
        $this->data1 = $data1;
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function sheets(): array
    {
        return [
            'Bantuan Alat' => new AlatOneExportDate($this->data1, $this->date1, $this->date2),
            'Pelatihan' => new PelatihanOneExportDate($this->data1, $this->date1, $this->date2),
            'Sertifikat' => new SertifikatOneExportDate($this->data1, $this->date1, $this->date2)
        ];
    }
}
