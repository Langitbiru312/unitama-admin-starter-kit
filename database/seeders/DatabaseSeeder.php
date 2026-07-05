<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan memanggil model User

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Perintah untuk membuat 50 data user tiruan sekaligus
        User::factory(50)->create();

         $this->call([
            UserSeeder::class,
            SettingSeeder::class,
        ]);
    }
}