<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('settings')->insert([
            'setting_name' => 'phone',
            'setting_value' => '013434343',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'email',
            'setting_value' => 'admin@gmail.com',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'fb-link',
            'setting_value' => 'facebook',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'tw-link',
            'setting_value' => 'twitter',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'link-link',
            'setting_value' => 'linkden',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'tw-link',
            'setting_value' => 'twitter',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'address',
            'setting_value' => 'Hatir matha',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'description',
            'setting_value' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
        ]);
    }
}
