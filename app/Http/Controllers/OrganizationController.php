<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Services\OrganizationService;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    private OrganizationService $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('organization.index', [
            'title' => 'Organizations',
            'organizations' => $this->organizationService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organization.form', [
            'title' => 'Create Organization',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->organizationService->post($request->all());
        return redirect()->route('organization.index')->with('success', 'Organization created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->organizationService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organization $organization)
    {
        return view('organization.form', [
            'title' => 'Edit Organization',
            'organization' => $organization
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id ,Request $request)
    {

        $data = $request->all();
        $data['id'] = $id;
        $this->organizationService->put($data);
        return redirect()->route('organization.index')->with('success', 'Organization updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->organizationService->delete($id);
        return redirect()->route('organization.index')->with('success', 'Organization deleted successfully.');
    }
}
