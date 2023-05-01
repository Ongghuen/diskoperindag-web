<?php

namespace App\Exports;

use App\Models\Bantuan;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $rowNumber = 0;

    public function collection()
    {
        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->get();

        $pelatihan = Pelatihan::with('user.role')
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->get();

        $sertifikat = Sertifikat::with('user.role')
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
}