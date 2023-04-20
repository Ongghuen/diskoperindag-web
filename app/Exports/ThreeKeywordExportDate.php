<?php

namespace App\Exports;

use App\Exports\AlatThreeExport;
use App\Exports\UserThreeExportDate;
use App\Exports\PelatihanThreeExport;
use App\Exports\SertifikatThreeExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ThreeKeywordExportDate implements WithMultipleSheets
{
    protected $data1;
    protected $data2;
    protected $data3;
    protected $date1;
    protected $date2;

    function __construct($data1, $data2, $data3, $date1, $date2) {
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->data3 = $data3;
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function sheets(): array
    {
        return [
            'Induk Pengguna' => new UserThreeExportDate($this->data1, $this->data2, $this->data3, $this->date1, $this->date2),
            'Bantuan Alat' => new AlatThreeExportDate($this->data1, $this->data2, $this->data3, $this->date1, $this->date2),
            'Pelatihan' => new PelatihanThreeExportDate($this->data1, $this->data2, $this->data3, $this->date1, $this->date2),
            'Sertifikat' => new SertifikatThreeExportDate($this->data1, $this->data2, $this->data3, $this->date1, $this->date2)
        ];
    }
}
