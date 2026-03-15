<?php

use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminAnalyticsController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminBlogPostController;
use App\Http\Controllers\AdminCareerController;
use App\Http\Controllers\AdminContactInquiryController;
use App\Http\Controllers\AdminContractController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDivisionPositionController;
use App\Http\Controllers\AdminFaqController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\AdminHeaderFooterController;
use App\Http\Controllers\AdminJobApplicationController;
use App\Http\Controllers\AdminLeadController;
use App\Http\Controllers\AdminNannyInquiryController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminPageWordingController;
use App\Http\Controllers\AdminPasswordController;
use App\Http\Controllers\AdminRolePageWordingController;
use App\Http\Controllers\AdminServiceAreaController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AiAgentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CareerCategoryController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactInquiryController;
use App\Http\Controllers\GlobalStaffingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NannyInquiryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\SitemapPageController;
use App\Http\Middleware\EnsureUserRole;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index']);
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactInquiryController::class, 'store'])->name('contact.store');
Route::get('/forms/nannies-inquiry', [NannyInquiryController::class, 'create'])->name('forms.nannies-inquiry');
Route::post('/forms/nannies-inquiry', [NannyInquiryController::class, 'store'])->name('forms.nannies-inquiry.store');
Route::view('/who-we-are', 'who-we-are')->name('who-we-are');
Route::view('/what-we-offer', 'what-we-offer')->name('what-we-offer');
Route::view('/our-people-your-dream-team', 'our-people-your-dream-team')->name('our-people-your-dream-team');
Route::view('/our-purpose-business-principles', 'our-purpose-business-principles')->name('our-purpose-business-principles');
Route::view('/terms-and-condition', 'terms-and-condition')->name('terms-and-condition');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');
Route::get('/airport-services/nanny-concierge', [ServiceDetailController::class, 'airportServices'])->name('airport-services.nanny-concierge');
Route::view('/airport-services/baggage-drop-off', 'airport-baggage-drop-off')->name('airport-services.baggage-drop-off');
Route::get('/airport-services/nanny-concierge/areas/{areaSlug}', [ServiceDetailController::class, 'airportServicesArea'])->name('airport-services.nanny-concierge.area');
Route::redirect('/airport-services', '/airport-services/nanny-concierge');
Route::view('/services/wedding-organizer', 'wedding-organizer')->name('services.wedding-organizer');
Route::view('/services/destination-weddings-australians-bali', 'destination-weddings-australians-bali')->name('services.destination-weddings-australians-bali');
Route::view('/services/bali-relocation-support', 'bali-relocation-support')->name('services.bali-relocation-support');
Route::view('/services/retire-in-bali', 'retire-in-bali')->name('services.retire-in-bali');
Route::view('/services/schoolies-australia-bali', 'schoolies-australia-bali')->name('services.schoolies-australia-bali');
Route::view('/services/schoolies-parents', 'schoolies-parents')->name('services.schoolies-parents');
Route::view('/services/schoolies-bali-packages', 'schoolies-bali-packages')->name('services.schoolies-bali-packages');
Route::view('/services/sectors/remote-worker', 'roles.remote-worker')->name('services.sectors.remote-worker');
Route::get('/services/sectors/{slug}', [ServiceDetailController::class, 'sector'])->name('services.sectors.show');
Route::get('/services/sectors/{slug}/areas/{areaSlug}', [ServiceDetailController::class, 'sectorArea'])->name('services.sectors.areas.show');
Route::redirect('/services/roles/remote-worker', '/services/sectors/remote-worker');
Route::get('/services/roles/{slug}', [ServiceDetailController::class, 'role'])->name('services.roles.show');
Route::get('/services/roles/{slug}/areas/{areaSlug}', [ServiceDetailController::class, 'roleArea'])->name('services.roles.areas.show');
Route::get('/services/areas/{areaSlug}', [ServiceDetailController::class, 'area'])->name('services.areas.show');
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
Route::get('/sitemap', SitemapPageController::class)->name('sitemap.page');
Route::get('/global-staffing/{country}', [GlobalStaffingController::class, 'show'])->name('global-staffing.country');
Route::redirect('/p/australia', '/global-staffing/australia');
Route::get('/{country}', [GlobalStaffingController::class, 'show'])
    ->where('country', 'australia|america|usa|us|united-states|united-states-of-america|america-usa|indonesia|bali|canada|malaysia|germany|singapore');

// Admin auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::middleware('guest')->group(function () {
    Route::get('/admin/forgot-password', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/admin/forgot-password', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('/admin/reset-password/{token}', [AdminForgotPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('/admin/reset-password', [AdminForgotPasswordController::class, 'reset'])->name('admin.password.reset.submit');
});

// Admin (protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/password', [AdminPasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [AdminPasswordController::class, 'update'])->name('password.update');

    // Shared for super admin and admin
    Route::middleware(EnsureUserRole::class.':super_admin,admin')->group(function () {
        Route::resource('careers', AdminCareerController::class)->except(['show']);
        Route::resource('blog-posts', AdminBlogPostController::class)->except(['show']);
        Route::resource('faqs', AdminFaqController::class)->except(['show']);
        Route::get('/applicants', [AdminJobApplicationController::class, 'index'])->name('applicants.index');
        Route::patch('/applicants/{application}/status', [AdminJobApplicationController::class, 'updateStatus'])->name('applicants.status');
        Route::get('/applicants/{application}/resume', [AdminJobApplicationController::class, 'resume'])->name('applicants.resume');
        Route::get('/applicants/{application}/documents/{type}', [AdminJobApplicationController::class, 'document'])->name('applicants.document');
        Route::get('/analytics', [AdminAnalyticsController::class, 'index'])->name('analytics.index');
        Route::get('/leads', [AdminLeadController::class, 'index'])->name('leads.index');
        Route::patch('/leads/{appointment}', [AdminLeadController::class, 'update'])->name('leads.update');
        Route::get('/contact-inquiries', [AdminContactInquiryController::class, 'index'])->name('contact-inquiries.index');
        Route::delete('/contact-inquiries/{contactInquiry}', [AdminContactInquiryController::class, 'destroy'])->name('contact-inquiries.destroy');
        Route::get('/contracts', [AdminContractController::class, 'index'])->name('contracts.index');
        Route::get('/contracts/create', [AdminContractController::class, 'create'])->name('contracts.create');
        Route::get('/contracts/preview', [AdminContractController::class, 'preview'])->name('contracts.preview');
        Route::post('/contracts/generate', [AdminContractController::class, 'generate'])->name('contracts.generate');
        Route::post('/contracts/responsibilities', [AdminContractController::class, 'storeResponsibility'])->name('contracts.responsibilities.store');
        Route::delete('/contracts/responsibilities', [AdminContractController::class, 'bulkDestroyResponsibilities'])->name('contracts.responsibilities.bulk-destroy');
        Route::patch('/contracts/responsibilities/{responsibility}', [AdminContractController::class, 'updateResponsibility'])->name('contracts.responsibilities.update');
        Route::delete('/contracts/responsibilities/{responsibility}', [AdminContractController::class, 'destroyResponsibility'])->name('contracts.responsibilities.destroy');
        Route::get('/contracts/{contract}/regenerate', [AdminContractController::class, 'regenerate'])->name('contracts.regenerate');
        Route::delete('/contracts/{contract}', [AdminContractController::class, 'destroy'])->name('contracts.destroy');
        Route::get('/nanny-inquiries', [AdminNannyInquiryController::class, 'index'])->name('nanny-inquiries.index');
        Route::post('/nanny-inquiries/wedding-events', [AdminNannyInquiryController::class, 'storeWeddingEvent'])->name('nanny-inquiries.wedding-events.store');
        Route::delete('/nanny-inquiries/wedding-events/{weddingEvent}', [AdminNannyInquiryController::class, 'destroyWeddingEvent'])->name('nanny-inquiries.wedding-events.destroy');
        Route::get('/nanny-inquiries/export-wedding', [AdminNannyInquiryController::class, 'exportWedding'])->name('nanny-inquiries.export-wedding');
        Route::delete('/nanny-inquiries/{nannyInquiry}', [AdminNannyInquiryController::class, 'destroy'])->name('nanny-inquiries.destroy');
    });

    // Appointment access: booking checker can only view, cannot mutate
    Route::middleware(EnsureUserRole::class.':super_admin,admin,booking_checker')->group(function () {
        Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    });
    Route::middleware(EnsureUserRole::class.':super_admin,admin')->group(function () {
        Route::patch('/appointments/{appointment}/approve', [AdminAppointmentController::class, 'approve'])->name('appointments.approve');
        Route::patch('/appointments/{appointment}/cancel', [AdminAppointmentController::class, 'cancel'])->name('appointments.cancel');
        Route::delete('/appointments/{appointment}', [AdminAppointmentController::class, 'destroy'])->name('appointments.destroy');
    });

    // Super admin only
    Route::middleware(EnsureUserRole::class.':super_admin')->group(function () {
        // User management
        Route::resource('users', AdminUserController::class)->except(['show']);

        Route::get('/division-position', [AdminDivisionPositionController::class, 'index'])->name('division-position.index');
        Route::get('/divisions', [AdminDivisionPositionController::class, 'divisionsIndex'])->name('divisions.index');
        Route::post('/divisions', [AdminDivisionPositionController::class, 'storeDivision'])->name('divisions.store');
        Route::delete('/divisions/{division}', [AdminDivisionPositionController::class, 'destroyDivision'])->name('divisions.destroy');
        Route::post('/divisions/sub-divisions', [AdminDivisionPositionController::class, 'storeSubDivision'])->name('divisions.sub-divisions.store');
        Route::delete('/divisions/sub-divisions/{subDivision}', [AdminDivisionPositionController::class, 'destroySubDivision'])->name('divisions.sub-divisions.destroy');
        Route::get('/roles-responsibilities', [AdminDivisionPositionController::class, 'rolesResponsibilitiesIndex'])->name('roles-responsibilities.index');
        Route::post('/roles-responsibilities/positions', [AdminDivisionPositionController::class, 'storePosition'])->name('roles-responsibilities.positions.store');
        Route::delete('/roles-responsibilities/positions/{position}', [AdminDivisionPositionController::class, 'destroyPosition'])->name('roles-responsibilities.positions.destroy');
        Route::post('/roles-responsibilities/responsibilities', [AdminDivisionPositionController::class, 'storeResponsibility'])->name('roles-responsibilities.responsibilities.store');
        Route::delete('/roles-responsibilities/responsibilities/{responsibility}', [AdminDivisionPositionController::class, 'destroyResponsibility'])->name('roles-responsibilities.responsibilities.destroy');

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
        Route::resource('service-areas', AdminServiceAreaController::class)
            ->parameters(['service-areas' => 'serviceArea'])
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
        Route::get('/page-wording', [AdminPageWordingController::class, 'edit'])->name('page-wording.edit');
        Route::put('/page-wording', [AdminPageWordingController::class, 'update'])->name('page-wording.update');
        Route::get('/role-page-wording', [AdminRolePageWordingController::class, 'index'])->name('role-page-wording.index');
        Route::get('/role-page-wording/{slug}', [AdminRolePageWordingController::class, 'edit'])->name('role-page-wording.edit');
        Route::put('/role-page-wording/{slug}', [AdminRolePageWordingController::class, 'update'])->name('role-page-wording.update');

        Route::post('/ai-agent/chat', [AiAgentController::class, 'chat'])->name('ai-agent.chat');
    });

});
