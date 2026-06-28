<?php

namespace App\Services\Implement;

use App\Models\AcademicYear;
use App\Models\House;
use App\Models\Member;
use App\Models\Point;
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

    public function post($members)
    {
        return DB::transaction(function () use ($members) {
            if (empty($members)) {
                throw new \Exception('No members selected.');
            }
            $houseId = $members[0]['house_id'];
            $academicYearId = $members[0]['academic_year_id'];
            // Semua people_id yang dikirim dari frontend
            $selectedPeopleIds = collect($members)
                ->pluck('people_id')
                ->toArray();
            // Cari member yang sudah ada tetapi tidak dipilih lagi
            $removedMembers = Member::where('house_id', $houseId)
                ->where('academic_year_id', $academicYearId)
                ->whereNotIn('people_id', $selectedPeopleIds)
                ->get();
            foreach ($removedMembers as $removedMember) {
                // Cek apakah sudah punya point
                $hasPoint = Point::where('member_id', $removedMember->id)
                    ->exists();
                if ($hasPoint) {
                    throw new \Exception(
                        $removedMember->person->fullname .
                        ' already has points and cannot be removed.'
                    );
                }
                // Belum punya point → boleh dihapus
                $removedMember->delete();
            }
            // Insert / Update member
            foreach ($members as $item) {
                $member = Member::where('people_id', $item['people_id'])
                    ->where('academic_year_id', $item['academic_year_id'])
                    ->first();
                if ($member) {
                    if ($member->house_id != $item['house_id']) {
                        $hasPoint = Point::where('member_id', $member->id)
                            ->exists();
                        if ($hasPoint) {
                            throw new \Exception(
                                $member->person->fullname .
                                ' already has points and cannot be moved.'
                            );
                        }
                        $member->update([
                            'house_id' => $item['house_id'],
                            'role' => $item['houseRole'],
                            'is_active' => 1,
                        ]);
                    } else {
                        $member->update([
                            'role' => $item['houseRole'],
                            'is_active' => 1,
                        ]);
                    }
                } else {
                    Member::create([
                        'people_id' => $item['people_id'],
                        'house_id' => $item['house_id'],
                        'academic_year_id' => $item['academic_year_id'],
                        'role' => $item['houseRole'],
                        'is_active' => 1,
                    ]);
                }
            }
            return true;
        });
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

    public function getHouseByActiveAcademicYear()
    {
        $activeAcademicYear = AcademicYear::where('is_active', 1)->first();
        if (!$activeAcademicYear) {
            throw new \Exception('No active academic year found.');
        }
        $houses = House::with([
            'members' => function ($query) use ($activeAcademicYear) {
                $query->where('academic_year_id', $activeAcademicYear->id);
            },
            'members.person'
        ])->get();
        return $houses;
    }

    public function getMembersByHouseAndYear($houseId, $yearId)
    {
        $members = Member::with('person')
            ->where('house_id', $houseId)
            ->where('academic_year_id', $yearId)
            ->get();
        return $members;
    }
}
