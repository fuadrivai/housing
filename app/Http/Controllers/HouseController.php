<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Services\HouseService;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private HouseService $houseService;

    public function __construct(HouseService $houseService)
    {
        $this->houseService = $houseService;
    }

    public function index()
    {
        return view('house.index', ['title' => 'Houses','houses' => $this->houseService->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('house.form', ['title' => 'Add House']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'motto' => 'required',
            'core' => 'required',
            'attribute' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $house = $this->houseService->post($request);

        return response()->json([
            'success' => true,
            'message' => 'House created successfully',
            'data' => $house
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $house = $this->houseService->show($id);
        return view('house.form', ['title' => 'Edit House', 'house' => $house]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'motto' => 'required',
            'core' => 'required',
            'attribute' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $house = $this->houseService->put($request);

        return response()->json([
            'success' => true,
            'message' => 'House updated successfully',
            'data' => $house
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        //
    }
}
