<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // website name
        DB::table('settings')->insert([
            'name' => 'website_name',
            'title' => 'نام وبسایت',
            'type' => 'text',
            'value' => 'وبسایت من',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // index title
        DB::table('settings')->insert([
            'name' => 'meta_title',
            'title' => 'عنوان صفحه اصلی',
            'type' => 'text',
            'value' => 'وبسایت من',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // index meta description
        DB::table('settings')->insert([
            'name' => 'meta_description',
            'title' => 'توضیحات متای صفحه اصلی',
            'type' => 'text',
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // admin email
        DB::table('settings')->insert([
            'name' => 'admin_email',
            'title' => 'ایمیل مدیر',
            'type' => 'email',
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // pages title delimiter
        DB::table('settings')->insert([
            'name' => 'title_delimiter',
            'title' => 'جداکننده نام صفحات',
            'type' => 'text',
            'value' => '-',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // google analytics api keys
        DB::table('settings')->insert([
            'name' => 'google_analyitics_client-id',
            'title' => 'کد احراز هویت گوگل آنالیتیکز',
            'type' => 'text',
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // site logo
        DB::table('settings')->insert([
            'name' => 'logo_src',
            'title' => 'آدرس عکس لوگو',
            'type' => 'text',
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
