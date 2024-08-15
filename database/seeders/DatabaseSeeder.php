<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\BarangSeeder;
use App\Models\Barang;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create default user
        $this->call(UserSeeder::class);

        // create dummy records for Barangs & Resi
        Barang::factory()->count(40)->create();

        // create dummt records for User with password = password
        User::factory()->count(10)->create();
    }
}
