<?php

namespace App\Http\Controllers;

use App\Services\AcademicYearService;
use App\Services\HouseService;
use App\Services\MemberService;
use App\Services\OrganizationService;
use App\Services\PeopleService;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    private OrganizationService $organizationService;
    private PeopleService $peopleService;
    private AcademicYearService $academicYearService;
    private HouseService $houseService;
    private MemberService $memberService;

    public function __construct(
        OrganizationService $organizationService, 
        PeopleService $peopleService,
        AcademicYearService $academicYearService,
        HouseService $houseService,
        MemberService $memberService,
    )
    {
        $this->organizationService = $organizationService;
        $this->peopleService = $peopleService;
        $this->academicYearService = $academicYearService;
        $this->houseService = $houseService;
        $this->memberService = $memberService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicYears = $this->academicYearService->getActive();
        $houses = $this->memberService->getHouseByActiveAcademicYear();
        return view('member.index', [
            'title' => 'Members',
            'houses' => $houses,
            'academicYears' => $academicYears,
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
        $validated = $request->validate([
            '*.people_id' => 'required|exists:people,id',
            '*.house_id' => 'required|exists:houses,id',
            '*.academic_year_id' => 'required|exists:academic_years,id',
            '*.houseRole' => 'required|in:captain,vice_captain,advisor,member',
        ]);

        try {

            $data = $this->memberService->post($validated);

            return response()->json([
                'success' => true,
                'message' => 'Members saved successfully.',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
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

    public function editHouseMember($houseId, $yearId)
    {
        $academicYears = $this->academicYearService->get();
        $houses = $this->houseService->get();
        $persons = $this->peopleService->get();
        $organizations = $this->organizationService->get();
        return view('member.form', [
            'title' => 'Edit Member',
            'academicYears' => $academicYears,
            'houses' => $houses,
            'persons' => $persons,
            'houseId' => $houseId,
            'yearId' => $yearId,
            'organizations'=> $organizations,
        ]);
    }

    public function getMembersByHouseAndYear($houseId, $yearId)
    {
        return $this->memberService->getMembersByHouseAndYear($houseId, $yearId);
    }

}
