<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Services\AcademicYearService;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private AcademicYearService $academicYearService;
    public function __construct(AcademicYearService $academicYearService)
    {
        $this->academicYearService = $academicYearService;
    }
    public function index()
    {
        return view('academic-year.index', ['title' => 'Academic Years',
            'academicYears' => $this->academicYearService->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $academicYear = $this->academicYearService->post($data);

        return response()->json(['message' => 'Academic Year created successfully', 'academicYear' => $academicYear], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);
        $data['id'] = $id;

        $academicYear = $this->academicYearService->put($data);

        return response()->json(['message' => 'Academic Year updated successfully', 'academicYear' => $academicYear], 200);
    }

    public function toggleActive(Request $request)
    {
        $academicYear = $this->academicYearService->toggleActive($request);

        return response()->json(['message' => 'Academic Year active status updated successfully', 'academicYear' => $academicYear], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
