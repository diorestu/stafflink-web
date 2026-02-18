<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminJobApplicationController;
use App\Http\Controllers\AdminCareerController;
use App\Http\Controllers\AdminHeaderFooterController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AiAgentController;
use App\Http\Controllers\AdminBlogPostController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CareerCategoryController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ServiceDetailController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index']);
Route::view('/contact', 'contact')->name('contact');
Route::view('/who-we-are', 'who-we-are')->name('who-we-are');
Route::view('/what-we-offer', 'what-we-offer')->name('what-we-offer');
Route::view('/our-people-your-dream-team', 'our-people-your-dream-team')->name('our-people-your-dream-team');
Route::view('/our-purpose-business-principles', 'our-purpose-business-principles')->name('our-purpose-business-principles');
Route::view('/airport-services/nanny-concierge', 'nanny-concierge')->name('airport-services.nanny-concierge');
Route::redirect('/airport-services', '/airport-services/nanny-concierge');
Route::get('/services/sectors/{slug}', [ServiceDetailController::class, 'sector'])->name('services.sectors.show');
Route::get('/services/roles/{slug}', [ServiceDetailController::class, 'role'])->name('services.roles.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{blogPost:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/jobs', [CareerController::class, 'index'])->name('jobs.index');
Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointments.create');
Route::get('/appointment/availability', [AppointmentController::class, 'availability'])->name('appointments.availability');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/apply-now', [JobApplicationController::class, 'create'])->name('applications.create');
Route::post('/apply-now', [JobApplicationController::class, 'store'])->name('applications.store');
Route::get('/references/{token}', [ReferenceController::class, 'show'])->name('references.show');
Route::get('/p/{slug}', [PageController::class, 'show'])->name('pages.show');

// Admin auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin (protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Shared for super admin and admin
    Route::middleware('role:super_admin,admin')->group(function () {
        Route::resource('careers', AdminCareerController::class)->except(['show']);
        Route::resource('blog-posts', AdminBlogPostController::class)->except(['show']);
        Route::get('/applicants', [AdminJobApplicationController::class, 'index'])->name('applicants.index');
        Route::patch('/applicants/{application}/status', [AdminJobApplicationController::class, 'updateStatus'])->name('applicants.status');
        Route::get('/applicants/{application}/resume', [AdminJobApplicationController::class, 'resume'])->name('applicants.resume');
        Route::get('/applicants/{application}/documents/{type}', [AdminJobApplicationController::class, 'document'])->name('applicants.document');
        Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
        Route::patch('/appointments/{appointment}/approve', [AdminAppointmentController::class, 'approve'])->name('appointments.approve');
    });

    // Super admin only
    Route::middleware('role:super_admin')->group(function () {
        // User management
        Route::resource('users', AdminUserController::class)->except(['show']);

        // Page Sections
        Route::get('/sections', [AdminController::class, 'index'])->name('sections.index');
        Route::get('/sections/{section}/edit', [AdminController::class, 'edit'])->name('sections.edit');
        Route::put('/sections/{section}', [AdminController::class, 'update'])->name('sections.update');

        // Jobs
        Route::delete('/jobs/bulk-delete', [JobController::class, 'bulkDestroy'])->name('jobs.bulk-destroy');
        Route::post('/jobs/ai-description', [JobController::class, 'generateDescription'])->name('jobs.ai-description');
        Route::resource('jobs', JobController::class)->except(['show']);
        Route::resource('career-categories', CareerCategoryController::class)
            ->parameters(['career-categories' => 'careerCategory'])
            ->except(['show']);
        Route::prefix('locations')->name('locations.')->group(function () {
            Route::get('/db/countries', [LocationController::class, 'countriesFromDatabase'])->name('db.countries');
            Route::get('/db/states', [LocationController::class, 'statesFromDatabase'])->name('db.states');
            Route::get('/countries', [LocationController::class, 'countries'])->name('countries');
            Route::get('/countries/{countryIso2}/states', [LocationController::class, 'states'])->name('states');
            Route::post('/sync', [LocationController::class, 'sync'])->name('sync');
        });

        // Pages
        Route::resource('pages', AdminPageController::class)->except(['show']);
        Route::get('/pages/{page}/builder', [AdminPageController::class, 'builder'])->name('pages.builder');
        Route::put('/pages/{page}/builder', [AdminPageController::class, 'saveBuilder'])->name('pages.builder.update');

        // Header & Footer
        Route::get('/header-footer', [AdminHeaderFooterController::class, 'edit'])->name('header-footer.edit');
        Route::put('/header-footer', [AdminHeaderFooterController::class, 'update'])->name('header-footer.update');

        Route::post('/ai-agent/chat', [AiAgentController::class, 'chat'])->name('ai-agent.chat');
    });

});
