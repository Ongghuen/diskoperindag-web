<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Bantuan;
use App\Models\BantuanItem;
use App\Models\ItemBantuan;
use App\Models\UsersBantuan;
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

        User::factory()->count(10)->create();
        Bantuan::factory()->count(10)->create();
        ItemBantuan::factory()->count(20)->create();
        UsersBantuan::factory()->count(15)->create();
        BantuanItem::factory()->count(30)->create();
    }
}
