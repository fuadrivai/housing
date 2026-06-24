<?php

namespace App\Services\Implement;

use App\Models\Organization;
use App\Services\OrganizationService;
use Illuminate\Support\Facades\DB;

class OrganizationImplement implements OrganizationService
{
    public function get()
    {
        return Organization::all();
    }

    public function show($id)
    {
        return Organization::findOrFail($id);
    }

    public function post($data)
    {
        
        $organization = Organization::create([
            'name' => $data['name'],
        ]);
        return $organization;
    }

    public function put($data)
    {
        return DB::transaction(function () use ($data) {
            $organization = Organization::findOrFail($data['id']);
            $organization->update([
                'name' => $data['name']
            ]);
            return $organization->fresh();
        });
    }


    public function delete($id)
    {
        $organization = Organization::findOrFail($id);
        return $organization->delete();
    }
}
