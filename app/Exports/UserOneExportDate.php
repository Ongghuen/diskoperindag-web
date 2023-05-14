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

class UserOneExportDate implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
{
    protected $keyword1;
    protected $keyword2;
    protected $keyword3;
    protected $rowNumber = 0;

    function __construct($data1, $date1, $date2) {
        $this->keyword1 = $data1;
        $this->keyword2 = $date1;
        $this->keyword3 = $date2;
    }
    
    public function collection()
    {
        $data = $this->keyword1;
        $date1 = $this->keyword2;
        $date2 = $this->keyword3;

        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data.'%')
                    ->orwhereHas('user', function ($query) use($data){
                        $query
                        ->where('name', 'LIKE', '%'.$data.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data.'%');
                    });
                })
                ->whereBetween('tahun_pemberian', [$date1, $date2])
                ->whereHas('user.role', function($query) use($data){
                    $query
                    ->where('name', 'User');
                })
                ->get();
        
        $pelatihan = Pelatihan::with('user.role')
                ->where(function ($query) use($data){
                    $query
                    ->where('nama', 'LIKE', '%'.$data.'%')
                    ->orWhere('penyelenggara', 'LIKE', '%'.$data.'%')
                    ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data.'%')
                    ->orWhere('tempat', 'LIKE', '%'.$data.'%')
                    ->orwhereHas('user', function ($query) use($data){
                        $query
                        ->where('name', 'LIKE', '%'.$data.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data.'%');
                    });
                })
                ->whereBetween('created_at', [$date1, $date2])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->get();

        $sertifikat = Sertifikat::with('user.role')
                ->where(function ($query) use($data){
                    $query
                    ->where('no_sertifikat', 'LIKE', '%'.$data.'%')
                    ->orWhere('nama', 'LIKE', '%'.$data.'%')
                    ->orWhere('tanggal_terbit', 'LIKE', '%'.$data.'%')
                    ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data.'%')
                    ->orwhereHas('user', function ($query) use($data){
                        $query
                        ->where('name', 'LIKE', '%'.$data.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data.'%');
                    });
                })
                ->whereBetween('created_at', [$date1, $date2])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
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

        foreach($sertifikat as $data){
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
