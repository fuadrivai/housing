<?php

namespace App\Http\Controllers;

use App\Services\AcademicYearService;
use App\Services\BranchService;
use App\Services\HouseService;
use App\Services\OrganizationService;
use App\Services\peopleService;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    private BranchService $branchService;
    private OrganizationService $organizationService;
    private peopleService $peopleService;
    private AcademicYearService $academicYearService;
    private HouseService $houseService;

    public function __construct(
        BranchService $branchService, 
        OrganizationService $organizationService, 
        PeopleService $peopleService,
        AcademicYearService $academicYearService,
        HouseService $houseService,
    )
    {
        $this->branchService = $branchService;
        $this->organizationService = $organizationService;
        $this->peopleService = $peopleService;
        $this->academicYearService = $academicYearService;
        $this->houseService = $houseService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.index', [
            'title' => 'Members',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academicYears = $this->academicYearService->get();
        $houses = $this->houseService->get();
        $persons = $this->peopleService->get();
        $organizations = $this->organizationService->get();
        return view('member.form', [
            'title' => 'Setup Member',
            'academicYears' => $academicYears,
            'houses' => $houses,
            'persons' => $persons,
            'organizations'=> $organizations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->peopleService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)

    {
        $academicYears = $this->academicYearService->get();
        $houses = $this->houseService->get();
        $persons = $this->peopleService->get();
        return view('member.form', [
            'title' => 'Edit Member',
            'academicYears' => $academicYears,
            'houses' => $houses,
            'persons' => $persons,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
