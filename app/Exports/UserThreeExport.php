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

class UserThreeExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithEvents
{
    protected $keyword1;
    protected $keyword2;
    protected $keyword3;
    protected $rowNumber = 0;

    function __construct($data1, $data2, $data3) {
        $this->keyword1 = $data1;
        $this->keyword2 = $data2;
        $this->keyword3 = $data3;
    }
    
    public function collection()
    {
        $data1 = $this->keyword1;
        $data2 = $this->keyword2;
        $data3 = $this->keyword3;
        $bantuan = Bantuan::with(['user.role', 'itemBantuan'])
                ->where(function ($query) use($data1){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data1.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data1.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data1.'%')
                    ->orwhereHas('user', function ($query) use($data1){
                        $query
                        ->where('name', 'LIKE', '%'.$data1.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data1){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data1.'%');
                    });
                })
                ->where(function ($query) use($data2){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data2.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data2.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data2.'%')
                    ->orwhereHas('user', function ($query) use($data2){
                        $query
                        ->where('name', 'LIKE', '%'.$data2.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data2){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data2.'%');
                    });
                })
                ->where(function ($query) use($data3){
                    $query
                    ->where('jenis_usaha', 'LIKE', '%'.$data3.'%')
                    ->orWhere('nama_bantuan', 'LIKE', '%'.$data3.'%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%'.$data3.'%')
                    ->orwhereHas('user', function ($query) use($data3){
                        $query
                        ->where('name', 'LIKE', '%'.$data3.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                    })
                    ->orWherehas('itemBantuan', function ($query) use($data3){
                        $query
                        ->where('nama_item', 'LIKE', '%'.$data3.'%');
                    });
                })
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->get();

        $pelatihan = Pelatihan::with('user.role')
                ->where(function ($query) use($data1){
                    $query
                    ->where('nama', 'LIKE', '%'.$data1.'%')
                    ->orWhere('penyelenggara', 'LIKE', '%'.$data1.'%')
                    ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data1.'%')
                    ->orWhere('tempat', 'LIKE', '%'.$data1.'%')
                    ->orwhereHas('user', function ($query) use($data1){
                        $query
                        ->where('name', 'LIKE', '%'.$data1.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                    });
                })
                ->where(function ($query) use($data2){
                    $query
                    ->where('nama', 'LIKE', '%'.$data2.'%')
                    ->orWhere('penyelenggara', 'LIKE', '%'.$data2.'%')
                    ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data2.'%')
                    ->orWhere('tempat', 'LIKE', '%'.$data2.'%')
                    ->orwhereHas('user', function ($query) use($data2){
                        $query
                        ->where('name', 'LIKE', '%'.$data2.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                    });
                })
                ->where(function ($query) use($data3){
                    $query
                    ->where('nama', 'LIKE', '%'.$data3.'%')
                    ->orWhere('penyelenggara', 'LIKE', '%'.$data3.'%')
                    ->orWhere('tanggal_pelaksanaan', 'LIKE', '%'.$data3.'%')
                    ->orWhere('tempat', 'LIKE', '%'.$data3.'%')
                    ->orwhereHas('user', function ($query) use($data3){
                        $query
                        ->where('name', 'LIKE', '%'.$data3.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
                    });
                })
                ->whereHas('user.role', function($query){
                    $query
                    ->where('name', 'User');
                })
                ->get();

        $sertifikat = Sertifikat::with('user.role')
                ->where(function ($query) use($data1){
                    $query
                    ->where('no_sertifikat', 'LIKE', '%'.$data1.'%')
                    ->orWhere('nama', 'LIKE', '%'.$data1.'%')
                    ->orWhere('tanggal_terbit', 'LIKE', '%'.$data1.'%')
                    ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data1.'%')
                    ->orwhereHas('user', function ($query) use($data1){
                        $query
                        ->where('name', 'LIKE', '%'.$data1.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data1.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data1.'%');
                    });
                })
                ->where(function ($query) use($data2){
                    $query
                    ->where('no_sertifikat', 'LIKE', '%'.$data2.'%')
                    ->orWhere('nama', 'LIKE', '%'.$data2.'%')
                    ->orWhere('tanggal_terbit', 'LIKE', '%'.$data2.'%')
                    ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data2.'%')
                    ->orwhereHas('user', function ($query) use($data2){
                        $query
                        ->where('name', 'LIKE', '%'.$data2.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data2.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data2.'%');
                    });
                })
                ->where(function ($query) use($data3){
                    $query
                    ->where('no_sertifikat', 'LIKE', '%'.$data3.'%')
                    ->orWhere('nama', 'LIKE', '%'.$data3.'%')
                    ->orWhere('tanggal_terbit', 'LIKE', '%'.$data3.'%')
                    ->orWhere('kadaluarsa_penyelenggara', 'LIKE', '%'.$data3.'%')
                    ->orwhereHas('user', function ($query) use($data3){
                        $query
                        ->where('name', 'LIKE', '%'.$data3.'%')
                        ->orWhere('NIK', 'LIKE', '%'.$data3.'%')
                        ->orWhere('alamat', 'LIKE', '%'.$data3.'%');
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
