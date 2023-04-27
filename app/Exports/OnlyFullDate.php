<?php

namespace App\Exports;

use App\Exports\AlatOnlyFullDate;
use App\Exports\UserOnlyFullDate;
use App\Exports\PelatihanOnlyFullDate;
use App\Exports\SertifikatOnlyFullDate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OnlyFullDate implements WithMultipleSheets
{
    protected $date1;
    protected $date2;

    function __construct($date1, $date2) {
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function sheets(): array
    {
        return [
            'Induk Pengguna' => new UserOnlyFullDate($this->date1, $this->date2),
            'Bantuan Alat' => new AlatOnlyFullDate($this->date1, $this->date2),
            'Pelatihan' => new PelatihanOnlyFullDate($this->date1, $this->date2),
            'Sertifikat' => new SertifikatOnlyFullDate($this->date1, $this->date2)
        ];
    }
}
