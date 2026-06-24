<?php

namespace App\Services\Implement;

use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Support\Facades\DB;

class BranchImplement implements BranchService
{
    public function get()
    {
        return Branch::all();
    }

    public function show($id)
    {
        return Branch::findOrFail($id);
    }

    public function post($data)
    {
        
        $branch = Branch::create([
            'name' => $data['name'],
        ]);
        return $branch;
    }

    public function put($data)
    {
        return DB::transaction(function () use ($data) {
            $branch = Branch::findOrFail($data['id']);
            $branch->update([
                'name' => $data['name']
            ]);
            return $branch->fresh();
        });
    }


    public function delete($id)
    {
        $branch = Branch::findOrFail($id);
        return $branch->delete();
    }
}
