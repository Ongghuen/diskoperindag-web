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

class UserOneExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
{
    protected $keyword;
    protected $rowNumber = 0;

    function __construct($data1) {
        $this->keyword = $data1;
    }

    public function collection() //function untuk memilih data yang akan diexport
    {
        $data = $this->keyword;
        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data){
                    $query
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
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->get();

        $sertifikat = Sertifikat::with('user.role')
                ->where(function ($query) use($data){
                    $query
                    ->where('nama', 'LIKE', '%'.$data.'%')
                    ->orWhere('tanggal_terbit', 'LIKE', '%'.$data.'%')
                    ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data.'%')
                    ->orwhereHas('user', function ($query) use($data){
                        $query
                        ->where('name', 'LIKE', '%'.$data.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data.'%');
                    });
                })
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

    public function map($row): array //function untuk mengambil data dari query function collection
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

    public function headings(): array //function untuk membuat headings excel
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

    public function title(): string //function untuk membuat judul sheet
    {
        return 'Induk Pengguna';
    }

    public function registerEvents(): array //function untuk auto width column laravel excel
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->autoSize();
            },
        ];
    }
}
