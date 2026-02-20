<?php

namespace App\Providers;

use App\Events\ApplicantStatusUpdated;
use App\Events\AppointmentApproved;
use App\Listeners\CreateTeamsEventOnAppointmentApproved;
use App\Listeners\SendApplicantStatusNotification;
use App\Listeners\SendAppointmentApprovedNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Support older MySQL/MariaDB index byte limits with utf8mb4.
        Schema::defaultStringLength(191);
        Model::preventLazyLoading(!app()->isProduction());

        Event::listen(AppointmentApproved::class, SendAppointmentApprovedNotification::class);
        Event::listen(AppointmentApproved::class, CreateTeamsEventOnAppointmentApproved::class);
        Event::listen(ApplicantStatusUpdated::class, SendApplicantStatusNotification::class);
    }
}
