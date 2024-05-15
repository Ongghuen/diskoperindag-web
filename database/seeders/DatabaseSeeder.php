<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Alat;
use App\Models\Role;
use App\Models\User;
use App\Models\Berita;
use App\Models\Bantuan;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
use App\Models\BantuanAlat;
use App\Models\UserPelatihan;
use App\Models\UserSertifikat;
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
            'name' => 'Ifa',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'NIK' => '999999999999999',
            'alamat' => 'Bondowoso',
            'phone' => '0899999999999',
            'gender' => 'L',
            'umur' => '20',
            'role_id' => '1'
        ]);

        User::factory()->count(20)->create();
        Bantuan::factory()->count(10)->create();
        Alat::factory()->count(20)->create();
        Sertifikat::factory()->count(20)->create();
        Pelatihan::factory()->count(20)->create();
        BantuanAlat::factory()->count(30)->create();
        UserPelatihan::factory()->count(30)->create();
        UserSertifikat::factory()->count(30)->create();
        Berita::factory()->count(5)->create();
    }
}
