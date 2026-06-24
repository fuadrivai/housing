<?php

namespace App\Services\Implement;

use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Support\Facades\DB;

class MemberImplement implements MemberService
{
    public function get()
    {
        return Member::all();
    }

    public function show($id)
    {
        return Member::findOrFail($id);
    }

    public function post($data)
    {
        //
    }

    public function put($data)
    {
        //
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {

            $member = Member::findOrFail($id);

            $member->delete();

            return true;
        });
    }
}
