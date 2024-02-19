<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tag: PHP
        DB::table('tags')->insert([
            'name' => 'پی‌اچ‌پی',
            'slug' => 'php',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        // Tag: Javascript
        DB::table('tags')->insert([
            'name' => 'جاوا اسکریپت',
            'slug' => 'javascript',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        // Tag: Node js
        DB::table('tags')->insert([
            'name' => 'نود جی‌اس',
            'slug' => 'node-js',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        // Tag: Laravel
        DB::table('tags')->insert([
            'name' => 'لاراول',
            'slug' => 'laravel',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
