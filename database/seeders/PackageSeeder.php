<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Basic Quran Reading
        Package::create([
            'title' => 'Basic Quran Reading',
            'slug' => 'basic-quran-reading',
            'description' => 'Start your journey with Noorani Qaida and Nazra Quran.',
            'features' => [
                'Noorani Qaida',
                'Nazra Quran',
                'Essential Duas',
                'One-on-One Classes',
                'Qualified Teachers'
            ],
            'price' => 40.00,
            'currency' => 'GBP',
            'duration_minutes' => 30,
            'days_per_week' => 3, // From image: 3 Days / Week
            'is_popular' => true,
            'color_theme' => 'green',
        ]);

        // 2. Tajweed & Recitation
        Package::create([
            'title' => 'Tajweed & Recitation',
            'slug' => 'tajweed-recitation',
            'description' => 'Master Quran recitation with proper Tajweed rules and Makharij.',
            'features' => [
                'Quran Recitation',
                'Tajweed Rules',
                'Makharij Practice',
                'Recitation Correction',
                'Weekly Assessments'
            ],
            'price' => 50.00,
            'currency' => 'GBP',
            'duration_minutes' => 40,
            'days_per_week' => 3, // From image: 3 Days / Week
            'is_popular' => false,
            'color_theme' => 'yellow',
        ]);

        // 3. Hifz Program
        Package::create([
            'title' => 'Hifz Program',
            'slug' => 'hifz-program',
            'description' => 'Comprehensive Hifz course with daily revision strategies.',
            'features' => [
                'Quran Memorization',
                'Daily Revision',
                'Sabqi & Manzil',
                'Memory Techniques',
                'Certificated Teachers'
            ],
            'price' => 50.00,
            'currency' => 'GBP',
            'duration_minutes' => 30, // Image says 30 Min / Class
            'days_per_week' => 3, // Image says 3 Days / Week for £50? Wait, other image says 60 Min / 6 Days / £10,000 PKR ~ £100? Sticking to image 2: £50/Month
            'is_popular' => false,
            'color_theme' => 'blue',
        ]);

        // 4. Islamic Studies
        Package::create([
            'title' => 'Islamic Studies',
            'slug' => 'islamic-studies',
            'description' => 'Learn Seerat-un-Nabi, Fiqh, and Islamic History.',
            'features' => [
                'Seerat-un-Nabi',
                'Basic Fiqh',
                'Islamic Values',
                'Islamic History',
                'Daily Duas'
            ],
            'price' => 70.00,
            'currency' => 'GBP',
            'duration_minutes' => 45, // From image
            'days_per_week' => 5, // From image
            'is_popular' => false,
            'color_theme' => 'purple',
        ]);

        // 5. Family Group Classes (Bonus)
        Package::create([
            'title' => 'Family Group Classes',
            'slug' => 'family-group',
            'description' => 'Enroll 3+ Family Members and pay a discounted rate.',
            'features' => [
                'Enroll 3+ Members',
                'Pay Only £100/Month',
                'Qualified Teachers',
                'Flexible Timings',
                'Progress Reports'
            ],
            'price' => 100.00,
            'currency' => 'GBP',
            'duration_minutes' => 30,
            'days_per_week' => 5,
            'is_popular' => false,
            'color_theme' => 'blue',
        ]);

        // 6. Grandparent Discount (Bonus)
        Package::create([
            'title' => 'Grandparent Discount',
            'slug' => 'grandparent-discount',
            'description' => 'Special discount for grandparents joining with family.',
            'features' => [
                '10% Off',
                'For Grandparents',
                'Joining with Family',
                'Flexible Schedule',
                'Patient Tutors'
            ],
            'price' => 40.00,
            'currency' => 'GBP',
            'duration_minutes' => 30,
            'days_per_week' => 5,
            'is_popular' => false,
            'color_theme' => 'purple',
        ]);
    }
}
