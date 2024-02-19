<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin: Alireza Bazargani
        DB::table('users')->insert([
            'name' => 'علیرضا',
            'family' => 'بازرگانی',
            'email' => 'arbazargani1998@gmail.com',
            'username' => 'root',
            'password' => bcrypt('adminstrator09308990856'),
            'rule' => 'admin',
            'managing_rule' => 'system',
            'state' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Admin: Saeed Khosravi
        DB::table('users')->insert([
            'name' => '',
            'family' => '',
            'email' => 'info@khsoravi.ir',
            'username' => 'sanix',
            'password' => bcrypt('sanix'),
            'rule' => 'admin',
            'state' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Mamber: Siamak Sazgar
        DB::table('users')->insert([
            'name' => 'سیامک',
            'family' => 'سازگار',
            'email' => 'info@azgar.ir',
            'username' => 'sia',
            'password' => bcrypt('sia'),
            'rule' => 'member',
            'state' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
