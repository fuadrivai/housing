<?php

namespace App\Services\Implement;

use App\Models\House;
use App\Models\Point;
use App\Services\PointService;
use Illuminate\Support\Facades\DB;

class PointImplement implements PointService
{
    public function get()
    {
        return Point::with([
            'member',
            'academicYear',
            'house'
        ])->get();
    }

    public function show($id)
    {
        return Point::with([
            'member',
            'academicYear',
            'house'
        ])->findOrFail($id);
    }

    public function post($data)
    {
        return DB::transaction(function () use ($data) {

            $point = Point::create([
                'member_id'      => $data['member_id']??null,
                'academic_year_id'=> $data['academic_year_id'],
                'value'          => $data['value'],
                'house_id'       => $data['house_id'],
                'type'           => $data['type'],
                'reason'         => $data['reason'],
                'created_by'     => $data['created_by'],
                'date'           => $data['date'],
            ]);

            return $point->fresh([
                'member',
                'academicYear',
                'house'
            ]);
        });
    }

    

    public function put($data)
    {
        return DB::transaction(function () use ($data) {

            $point = Point::findOrFail($data['id']);

            $point->update([
                'member_id'      => $data['member_id']??null,
                'academic_year_id'=> $data['academic_year_id'],
                'value'          => $data['value'],
                'house_id'       => $data['house_id'],
                'type'           => $data['type'],
                'reason'         => $data['reason'],
                'created_by'     => $data['created_by'],
                'date'           => $data['date'],
            ]);

            return $point->fresh([
                'member',
                'academicYear',
                'house'
            ]);
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $point = Point::findOrFail($id);
            $point->delete();
            return true;
        });
    }
    public function getHouseTotalPoint($yearId)
    {
        return House::with([
                'members' => function ($query) use ($yearId) {
                    $query->where('academic_year_id', $yearId);
                }
            ])
            ->leftJoin('points', function ($join) use ($yearId) {
                $join->on('houses.id', '=', 'points.house_id')
                    ->where('points.academic_year_id', $yearId);
            })
            ->select(
                'houses.*',
                DB::raw("
                    COALESCE(
                        SUM(
                            CASE
                                WHEN points.type = 'reward' THEN points.value
                                WHEN points.type = 'punishment' THEN -points.value
                                ELSE 0
                            END
                        ), 0
                    ) as total_points
                ")
            )
            ->groupBy('houses.id')
            ->orderByDesc('total_points')
            ->get();
    }
}
