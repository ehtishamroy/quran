<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Details
            ['group' => 'general', 'key' => 'site_name', 'value' => 'Suffa Islamic Center'],
            ['group' => 'general', 'key' => 'site_logo', 'value' => null],

            // Contact Information
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '+92-300-1234567'],
            ['group' => 'contact', 'key' => 'whatsapp_number', 'value' => '+92-300-1234567'],
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'info@suffaislamiccenter.com'],
            ['group' => 'contact', 'key' => 'contact_address', 'value' => '123 Islamic Center Road, City, Country'],

            // Social Media Links
            ['group' => 'social', 'key' => 'social_facebook', 'value' => 'https://facebook.com/suffacenter'],
            ['group' => 'social', 'key' => 'social_instagram', 'value' => 'https://instagram.com/suffacenter'],
            ['group' => 'social', 'key' => 'social_twitter', 'value' => 'https://twitter.com/suffacenter'],
            ['group' => 'social', 'key' => 'social_youtube', 'value' => 'https://youtube.com/suffacenter'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
