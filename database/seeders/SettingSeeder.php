<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'app_name'     => 'Admin Laravel',
            'copyright'    => 'Admin Laravel || 2026',
            'login_title'  => 'Admin Laravel',
            'description'  => 'Project Root Admin berbasis Laravel untuk manajemen sistem, kontrol pengguna, dan pengaturan aplikasi yang aman, cepat, dan responsif.',
            'keywords'     => 'panel admin laravel, sistem manajemen konten, dashboard admin root, cms laravel indonesia, aplikasi backend laravel, manajemen pengguna, sistem admin aman',
        ]);
    }
}