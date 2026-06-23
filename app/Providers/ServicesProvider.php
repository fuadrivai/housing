<?php

namespace App\Providers;

use App\Services\AcademicYearService;
use App\Services\HouseService;
use App\Services\Implement\AcademicYearImplement;
use App\Services\Implement\HouseImplement;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public array $singletons = [
        HouseService::class => HouseImplement::class,
        AcademicYearService::class => AcademicYearImplement::class,
    ];

    public function provides(): array
    {
        return [HouseService::class, AcademicYearService::class];
    }
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
