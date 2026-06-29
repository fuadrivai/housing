<?php

namespace App\Providers;

use App\Services\AcademicYearService;
use App\Services\BranchService;
use App\Services\HouseService;
use App\Services\Implement\AcademicYearImplement;
use App\Services\Implement\BranchImplement;
use App\Services\Implement\HouseImplement;
use App\Services\Implement\MemberImplement;
use App\Services\Implement\OrganizationImplement;
use App\Services\Implement\PeopleImplement;
use App\Services\Implement\PointImplement;
use App\Services\MemberService;
use App\Services\OrganizationService;
use App\Services\PeopleService;
use App\Services\PointService;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public array $singletons = [
        HouseService::class => HouseImplement::class,
        AcademicYearService::class => AcademicYearImplement::class,
        OrganizationService::class => OrganizationImplement::class,
        BranchService::class => BranchImplement::class,
        PeopleService::class => PeopleImplement::class,
        MemberService::class => MemberImplement::class,
        PointService::class => PointImplement::class,
    ];

    public function provides(): array
    {
        return [
            HouseService::class,
            AcademicYearService::class, 
            OrganizationService::class, 
            BranchService::class, 
            PeopleService::class, 
            MemberService::class,
            PointService::class
        ];
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
