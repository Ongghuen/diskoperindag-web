<?php

namespace App\Exports;

use App\Exports\AlatOneExport;
use App\Exports\PelatihanOneExport;
use App\Exports\SertifikatOneExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OneKeywordExport implements WithMultipleSheets
{
    protected $data1;

    function __construct($data1) { //function untuk menangkap vairabel data yang dikirim dari reportcontroller
        $this->data1 = $data1;
    }

    public function sheets(): array //function untuk mengambil data dari 4 sheet
    {
        return [
            'Induk Pengguna' => new UserOneExport($this->data1),
            'Bantuan Alat' => new AlatOneExport($this->data1),
            'Pelatihan' => new PelatihanOneExport($this->data1),
            'Sertifikat' => new SertifikatOneExport($this->data1)
        ];
    }
}
