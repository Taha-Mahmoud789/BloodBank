<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'fb_link' => 'https://facebook.com/default',
            'tw_link' => 'https://twitter.com/default',
            'yt_link' => 'https://youtube.com/default',
            'ins_link' => 'https://instagram.com/default',
            'notification_settings_text' => 'Default information about the application.',
            'phone' => '010-258-36974',
            'email' => 'default@example.com',
            'about_app' => 'Default information about the application.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
