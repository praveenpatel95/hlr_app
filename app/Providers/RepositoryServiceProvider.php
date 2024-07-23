<?php

namespace App\Providers;

use App\Repository\Contracts\FHIR\AppointmentInterface;
use App\Repository\Contracts\FHIR\PatientInterface;
use App\Repository\Contracts\FHIR\PractitionerInterface;
use App\Repository\Contracts\FHIR\ScheduleInterface;
use App\Repository\Contracts\UserInterface;
use App\Repository\Contracts\UserPreferenceInterface;
use App\Repository\FHIR\AppointmentRepository;
use App\Repository\FHIR\PatientRepository;
use App\Repository\FHIR\PractitionerRepository;
use App\Repository\FHIR\ScheduleRepository;
use App\Repository\User\UserPreferenceRepository;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);

        $this->app->bind(PatientInterface::class, PatientRepository::class);
        $this->app->bind(PractitionerInterface::class, PractitionerRepository::class);
        $this->app->bind(ScheduleInterface::class, ScheduleRepository::class);
        $this->app->bind(AppointmentInterface::class, AppointmentRepository::class);
    }

    public function boot(): void
    {
    }
}
