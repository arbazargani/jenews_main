<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category: Uncategorized
        DB::table('categories')->insert([
            'name' => 'بدون دسته‌بندی',
            'slug' => 'uncategorized',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        // Category: PHP
        DB::table('categories')->insert([
            'name' => 'پی‌اچ‌پی',
            'slug' => 'php',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        // Category: Javascript
        DB::table('categories')->insert([
            'name' => 'جاوا اسکریپت',
            'slug' => 'javascript',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        // Category: Node js
        DB::table('categories')->insert([
            'name' => 'نود جی‌اس',
            'slug' => 'node-js',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        // Category: Laravel
        DB::table('categories')->insert([
            'name' => 'لاراول',
            'slug' => 'laravel',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
