<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoryTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AdvertiseTableSeeder::class);
        $this->call(AddMoreSettings::class);
    }
}
