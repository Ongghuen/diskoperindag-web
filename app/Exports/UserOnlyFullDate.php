<?php

namespace App\Exports;

use App\Models\Bantuan;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserOnlyFullDate implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
{
    protected $keyword2;
    protected $keyword3;
    protected $rowNumber = 0;

    function __construct($date1, $date2) {
        $this->keyword2 = $date1;
        $this->keyword3 = $date2;
    }
    
    public function collection()
    {
        $date1 = $this->keyword2;
        $date2 = $this->keyword3;

        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
            ->whereHas('user.role', function($query){
                $query
                ->where('name', 'User');
            })
            ->whereBetween('tahun_pemberian', [$date1, $date2])
            ->get();

        $pelatihan = Pelatihan::with('user.role')
            ->whereHas('user.role', function($query){
                $query
                ->where('name', 'User');
            })
            ->whereBetween('created_at', [$date1, $date2])
            ->get();

        $sertifikat = Sertifikat::with('user.role')
            ->whereHas('user.role', function($query){
                $query
                ->where('name', 'User');
            })
            ->whereBetween('created_at', [$date1, $date2])
            ->get();

        $user = [];
        $gender = '';
        $kk = '';

        foreach($bantuan as $data){
            if($data->user->gender == 'P'){
                $gender = 'Perempuan';
            } else{
                $gender = 'Laki-Laki';
            }

            if($data->user->kepala_keluarga == 1){
                $kk = 'Iya';
            } else{
                $kk = 'Tidak';
            }

            $newUser = [
                'nama' => $data->user->name,
                'nik' => $data->user->NIK,
                'email' => $data->user->email,
                'alamat' => $data->user->alamat,
                'phone' => $data->user->phone,
                'gender' => $gender,
                'kk' => $kk,
                'tempat_lahir' => $data->user->tempat_lahir,
                'tanggal_lahir' => $data->user->tanggal_lahir,
                'umur' => $data->user->umur
            ];

            $found = false;
            foreach ($user as $item) {
                if ($item['nama'] === $newUser['nama']) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $user[] = $newUser;
            }
        }

        foreach($pelatihan as $data){
            foreach($data->user as $dataUser){
                if($dataUser->gender == 'P'){
                    $gender = 'Perempuan';
                } else{
                    $gender = 'Laki-Laki';
                }
    
                if($dataUser->kepala_keluarga == 1){
                    $kk = 'Iya';
                } else{
                    $kk = 'Tidak';
                }
    
                $newUser = [
                    'nama' => $dataUser->name,
                    'nik' => $dataUser->NIK,
                    'email' => $dataUser->email,
                    'alamat' => $dataUser->alamat,
                    'phone' => $dataUser->phone,
                    'gender' => $gender,
                    'kk' => $kk,
                    'tempat_lahir' => $dataUser->tempat_lahir,
                    'tanggal_lahir' => $dataUser->tanggal_lahir,
                    'umur' => $dataUser->umur
                ];
    
                $found = false;
                foreach ($user as $item) {
                    if ($item['nama'] === $newUser['nama']) {
                        $found = true;
                        break;
                    }
                }
    
                if (!$found) {
                    $user[] = $newUser;
                }
            }
        }

        foreach($sertifikat as $data){
            foreach($data->user as $dataUser){
                if($dataUser->gender == 'P'){
                    $gender = 'Perempuan';
                } else{
                    $gender = 'Laki-Laki';
                }
    
                if($dataUser->kepala_keluarga == 1){
                    $kk = 'Iya';
                } else{
                    $kk = 'Tidak';
                }
    
                $newUser = [
                    'nama' => $dataUser->name,
                    'nik' => $dataUser->NIK,
                    'email' => $dataUser->email,
                    'alamat' => $dataUser->alamat,
                    'phone' => $dataUser->phone,
                    'gender' => $gender,
                    'kk' => $kk,
                    'tempat_lahir' => $dataUser->tempat_lahir,
                    'tanggal_lahir' => $dataUser->tanggal_lahir,
                    'umur' => $dataUser->umur
                ];
    
                $found = false;
                foreach ($user as $item) {
                    if ($item['nama'] === $newUser['nama']) {
                        $found = true;
                        break;
                    }
                }
    
                if (!$found) {
                    $user[] = $newUser;
                }
            }
        }

        return collect($user);
    }

    public function map($row): array
    {
        ++$this->rowNumber;
        
        return [
            [
                $this->rowNumber,
                $row['nama'],
                $row['nik'],
                $row['email'],
                $row['alamat'],
                $row['phone'],
                $row['gender'],
                $row['kk'],
                $row['tempat_lahir'],
                $row['tanggal_lahir'],
                $row['umur']
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama',
            'NIK',
            'Email',
            'Alamat',
            'No telepon',
            'Jenis Kelamin',
            'Kepala Keluarga',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Umur'
        ];
    }

    public function title(): string
    {
        return 'Induk Pengguna';
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
