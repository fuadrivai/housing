<?php

namespace App\Http\Controllers;

use App\Services\AcademicYearService;
use App\Services\PointService;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private AcademicYearService $academicYearService;
    private PointService $pointService;

    public function __construct(AcademicYearService $academicYearService, PointService $pointService)
    {
        $this->academicYearService = $academicYearService;
        $this->pointService = $pointService;
    }

    public function index()
    {
        $academicYears = $this->academicYearService->getActive();
        return view('leaderboard.index', [
            'title' => 'Leaderboard',
            'academicYears' => $academicYears,
        ]);
    }

    public function getLeaderboardData($yearId)
    {
        $houses = $this->pointService->getHouseTotalPoint($yearId);
        return response()->json($houses);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
