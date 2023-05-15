<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Alat;
use App\Models\Role;
use App\Models\User;
use App\Models\Bantuan;
use App\Models\Berita;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
use App\Models\BantuanAlat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Super Admin'
        ]);

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
            'NIK' => '7128982898229102',
            'alamat' => 'Tempurejo, Jember',
            'phone' => '0895385501523',
            'gender' => 'L',
            'umur' => '20',
            'role_id' => '1'
        ]);

        User::create([
            'name' => 'Raihan Achmad',
            'email' => 'r@r',
            'password' => bcrypt('r'),
            'NIK' => '696969696969',
            'alamat' => 'Jember',
            'phone' => '089538558328',
            'gender' => 'L',
            'umur' => '20',
            'role_id' => '3'
        ]);

        User::create([
            'name' => 'Ilham Ibnu Ahmad',
            'email' => 'ilham@gmail.com',
            'password' => bcrypt('1234567890123456'),
            'NIK' => '1234567890123456',
            'alamat' => 'ProboProbo',
            'phone' => '089538558315',
            'gender' => 'L',
            'umur' => '20',
            'role_id' => '2'
        ]);

        User::factory()->count(10)->create();
        Bantuan::factory()->count(10)->create();
        Alat::factory()->count(20)->create();
        Sertifikat::factory()->count(20)->create();
        Pelatihan::factory()->count(20)->create();
        BantuanAlat::factory()->count(30)->create();
        Berita::factory()->count(5)->create();
    }
}
