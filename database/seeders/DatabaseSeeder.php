<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Alat;
use App\Models\Role;
use App\Models\User;
use App\Models\Bantuan;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
use App\Models\BantuanAlat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Admin'
        ]);

        Role::create([
            'name' => 'User'
        ]);

        User::create([
            'name' => 'Daffa Afifi Syahrony',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'NIK' => '712898289',
            'alamat' => 'Jember',
            'phone' => '+0895385583',
            'gender' => 'L',
            'umur' => '20',
            'role_id' => '1'
        ]);

        User::factory()->count(10)->create();
        Bantuan::factory()->count(10)->create();
        Alat::factory()->count(20)->create();
        Sertifikat::factory()->count(20)->create();
        Pelatihan::factory()->count(20)->create();
        BantuanAlat::factory()->count(30)->create();
    }
}
