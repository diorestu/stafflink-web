<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index']);
Route::view('/contact', 'contact')->name('contact');
Route::view('/who-we-are', 'who-we-are')->name('who-we-are');
Route::view('/what-we-offer', 'what-we-offer')->name('what-we-offer');
Route::view('/our-people-your-dream-team', 'our-people-your-dream-team')->name('our-people-your-dream-team');
Route::view('/our-purpose-business-principles', 'our-purpose-business-principles')->name('our-purpose-business-principles');
Route::view('/blog', 'blog')->name('blog');
Route::get('/jobs', [CareerController::class, 'index'])->name('jobs.index');
Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointments.create');
Route::get('/appointment/availability', [AppointmentController::class, 'availability'])->name('appointments.availability');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/apply-now', [JobApplicationController::class, 'create'])->name('applications.create');
Route::post('/apply-now', [JobApplicationController::class, 'store'])->name('applications.store');

// Admin auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin (protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Page Sections
    Route::get('/sections', [AdminController::class, 'index'])->name('sections.index');
    Route::get('/sections/{section}/edit', [AdminController::class, 'edit'])->name('sections.edit');
    Route::put('/sections/{section}', [AdminController::class, 'update'])->name('sections.update');

    // Jobs
    Route::resource('jobs', JobController::class);

    // Appointments
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}/approve', [AdminAppointmentController::class, 'approve'])->name('appointments.approve');
});
