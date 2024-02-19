<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddMoreSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // access status
        DB::table('settings')->insert([
            'name' => 'site_down',
            'title' => 'بستن سایت',
            'type' => 'text',
            'value' => '0',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // header codes
        DB::table('settings')->insert([
            'name' => 'before_body_codes',
            'title' => 'کدهای قبل از body',
            'type' => 'textarea',
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // footer codes
        DB::table('settings')->insert([
            'name' => 'end_body_codes',
            'title' => 'کدهای انتهای body',
            'type' => 'textarea',
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // footer codes
        DB::table('settings')->insert([
            'name' => 'menu_structure',
            'title' => 'ساختار فهرست سایت',
            'type' => 'textarea',
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // special archive
        DB::table('settings')->insert([
            'name' => 'special_archive',
            'title' => 'آرشیو ویژه‌نامه',
            'type' => 'text',
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
