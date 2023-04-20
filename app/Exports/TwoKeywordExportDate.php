<?php

namespace App\Exports;

use App\Exports\AlatTwoExport;
use App\Exports\UserTwoExportDate;
use App\Exports\PelatihanTwoExport;
use App\Exports\SertifikatTwoExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TwoKeywordExportDate implements WithMultipleSheets
{
    protected $data1;
    protected $data2;
    protected $date1;
    protected $date2;

    function __construct($data1, $data2, $date1, $date2) {
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function sheets(): array
    {
        return [
            'Induk Pengguna' => new UserTwoExportDate($this->data1, $this->data2, $this->date1, $this->date2),
            'Bantuan Alat' => new AlatTwoExportDate($this->data1, $this->data2, $this->date1, $this->date2),
            'Pelatihan' => new PelatihanTwoExportDate($this->data1, $this->data2, $this->date1, $this->date2),
            'Sertifikat' => new SertifikatTwoExportDate($this->data1, $this->data2, $this->date1, $this->date2)
        ];
    }
}
