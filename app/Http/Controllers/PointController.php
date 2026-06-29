<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Services\AcademicYearService;
use App\Services\HouseService;
use App\Services\MemberService;
use App\Services\PointService;
use Illuminate\Http\Request;

class PointController extends Controller
{

    private HouseService $houseService;
    private PointService $pointService;
    private AcademicYearService $academicYearService;
    private MemberService $memberService;
    /**
     * Display a listing of the resource.
     */

    public function __construct(HouseService $houseService, PointService $pointService, AcademicYearService $academicYearService, MemberService $memberService)
    {
        $this->houseService = $houseService;
        $this->pointService = $pointService;
        $this->academicYearService = $academicYearService;
        $this->memberService = $memberService;
    }
    public function index()
    {
        $academicYears = $this->academicYearService->getActive();
        $houses = $this->pointService->getHouseTotalPoint($academicYears->id ?? null);
        return view('point.index', [
            'title' => 'Point',
            'academicYears' => $academicYears,
            'houses' => $houses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $point = $this->pointService->post($request->all());
            return response()->json([
                'message' => 'Point created successfully.',
                'point' => $point,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Point $point)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Point $point)
    {
        //
    }
    public function editHousePoint($houseId, $yearId)
    {
        $academicYears = $this->academicYearService->get();
        $houses = $this->houseService->get();
        $members = $this->memberService->getMembersByHouseAndYear($houseId, $yearId);
        return view('point.form', [
            'title' => 'Point Form',
            'academicYears' => $academicYears,
            'houses' => $houses,
            'members' => $members,
            'houseId' => $houseId,
            'yearId' => $yearId,
        ]);
    }
    public function getPointsByHouseAndYear($houseId, $yearId)
    {
        
    }
}
