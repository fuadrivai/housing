<?php

namespace App\Services\Implement;

use App\Models\Member;
use App\Models\People;
use App\Services\peopleService;
use Illuminate\Support\Facades\DB;

class PeopleImplement implements PeopleService
{
    public function get()
    {
        return People::with([
            'branch',
            'organization',
            'member'
        ])->get();
    }

    public function show($id)
    {
        return People::with([
            'branch',
            'organization'
        ])->findOrFail($id);
    }

    public function post($data)
    {
        return DB::transaction(function () use ($data) {

            $person = People::create([
                'fullname'       => $data['fullname'],
                'nik'            => $data['nik'],
                'role'           => $data['role'],
                'branch_id'      => $data['branch_id'],
                'organization_id'=> $data['organization_id'],
                'grade'          => $data['grade'] ?? null,
            ]);

            return $person->fresh([
                'branch',
                'organization'
            ]);
        });
    }

    public function put($data)
    {
        return DB::transaction(function () use ($data) {

            $person = People::findOrFail($data['id']);

            $person->update([
                'nik'            => $data['nik'],
                'fullname'       => $data['fullname'],
                'role'           => $data['role'],
                'branch_id'      => $data['branch_id'],
                'organization_id'=> $data['organization_id'],
                'grade'          => $data['grade'] ?? null,
            ]);

            return $person->fresh([
                'branch',
                'organization'
            ]);
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {

            $person = People::findOrFail($id);

            $person->delete();

            return true;
        });
    }

    public function getPersonNomember($yearId)
    {
        return People::with([
            'branch',
            'organization',
            'member'=> function ($query) use ($yearId) {
                $query->where('academic_year_id', $yearId);
            }
        ])->get();
        return $people->load('member');
    }
}
