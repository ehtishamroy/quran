<?php

use App\Models\Package;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$updates = [
    'basic-quran-reading' => [
        'description' => 'Our Basic Quran Reading course is designed for children and beginners who want to start their Quran journey with proper guidance. We focus on correct pronunciation, foundational Tajweed, and confidence building.',
        'features' => [
            "Master Noorani Qaida",
            "Correct Arabic Pronunciation",
            "Smooth Quran Reading",
            "Learn Essential Daily Duas",
            "Build Love for the Quran"
        ],
        'price' => 40.00,
        'duration_minutes' => 30,
        'days_per_week' => 3
    ],
    'tajweed-recitation' => [
        'description' => 'This course is ideal for students who already know how to read but want to improve fluency and Tajweed accuracy.',
        'features' => [
            "Complete Tajweed Rules",
            "Makharij Correction",
            "Beautiful & Clear Recitation",
            "Weekly Revision & Mistake Correction"
        ],
        'price' => 50.00,
        'duration_minutes' => 30,
        'days_per_week' => 3
    ],
    'hifz-program' => [
        'description' => 'Our Hifz Program follows a systematic memorization plan to ensure strong retention and consistent revision.',
        'features' => [
            "Daily New Memorization",
            "Sabqi & Manzil Revision",
            "Weekly Tests",
            "Monthly Performance Review",
            "Parent Feedback",
            "Personalized Memorization Plan Included"
        ],
        'price' => 70.00,
        'duration_minutes' => 30,
        'days_per_week' => 5
    ],
    'islamic-studies' => [
        'description' => 'This course helps students understand Islam beyond recitation.',
        'features' => [
            "Seerat-un-Nabi ﷺ",
            "Basic Fiqh",
            "Islamic History",
            "Moral Development",
            "Important Hadith & Duas"
        ],
        'price' => 45.00,
        'duration_minutes' => 30,
        'days_per_week' => 3
    ]
];

foreach ($updates as $slug => $data) {
    Package::where('slug', $slug)->update([
        'description' => $data['description'],
        'features' => json_encode($data['features']),
        'price' => $data['price'],
        'duration_minutes' => $data['duration_minutes'],
        'days_per_week' => $data['days_per_week'],
    ]);
}

echo "Packages updated successfully.\n";
