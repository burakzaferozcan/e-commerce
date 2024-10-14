<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            "name" => "Adres",
            "data" => "Kocaeli adres bilgileri",
        ]);
        SiteSetting::create([
            "name" => "Telefon",
            "data" => "0555 555 55 55",
        ]);
        SiteSetting::create([
            "name" => "Email",
            "data" => "text@gmail.com",
        ]);
        SiteSetting::create([
            "name" => "Harita",
            "data" => null,
        ]);
    }
}
