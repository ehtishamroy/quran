<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CoursesController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CoursesController::class, 'show'])->name('courses.show');
Route::post('/enquiry', [FrontController::class, 'submitEnquiry'])->name('enquiry.submit');
Route::get('/blog', [FrontController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [FrontController::class, 'blogShow'])->name('blog.show');

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::resource('team-members', TeamMemberController::class);
    Route::resource('posts', PostController::class);
    Route::resource('enquiries', EnquiryController::class);
    Route::resource('packages', PackageController::class);
    Route::view('/guide', 'admin.guide')->name('guide');
});

// Serve storage files directly natively (Bypasses the need for storage:link on cPanel)
Route::get('storage/{path}', function ($path) {
    $fullPath = storage_path("app/public/{$path}");

    if (!file_exists($fullPath)) {
        abort(404);
    }

    $mimeType = \Illuminate\Support\Facades\File::mimeType($fullPath);

    return response()->file($fullPath, [
        'Content-Type' => $mimeType,
    ]);
})->where('path', '.*');
