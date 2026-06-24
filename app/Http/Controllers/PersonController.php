<?php

namespace App\Http\Controllers;

use App\Services\BranchService;
use App\Services\OrganizationService;
use App\Services\peopleService;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    private BranchService $branchService;
    private OrganizationService $organizationService;
    private peopleService $peopleService;

    public function __construct(BranchService $branchService, OrganizationService $organizationService, PeopleService $peopleService)
    {
        $this->branchService = $branchService;
        $this->organizationService = $organizationService;
        $this->peopleService = $peopleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = $this->peopleService->get();
        return view('person.index', [
            'title' => 'People',
            'people' => $people,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = $this->branchService->get();
        $organizations = $this->organizationService->get();
        return view('person.form', [
            'title' => 'Create Person',
            'branches' => $branches,
            'organizations' => $organizations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'nik' => 'string|max:255',
            'role'=>'required|string|max:255',
            'branch_id' => 'required|integer',
            'organization_id' => 'required|integer',
            'grade' => 'nullable|string|max:255',
        ]);
        $this->peopleService->post($data);
        return redirect()->route('person.index')->with('success', 'Person created successfully.');
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
        $person = $this->peopleService->show($id);

        $branches = $this->branchService->get();
        $organizations = $this->organizationService->get();
        return view('person.form', [
            'title' => 'Edit Person',
            'branches' => $branches,
            'organizations' => $organizations,
            'person' => $person,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'nik' => 'string|max:255',
            'role'=>'required|string|max:255',
            'branch_id' => 'required|integer',
            'organization_id' => 'required|integer',
            'grade' => 'nullable|string|max:255',
        ]);
        $data['id'] = $id;
        $this->peopleService->put($data);
        return redirect()->route('person.index')->with('success', 'Person updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getPeopleNoMember($yearId,$houseId)
    {
        $people = $this->peopleService->getPersonNomember($yearId, $houseId);
        return response()->json($people);
    }
}
