<?php

namespace App\Services\Implement;

use App\Models\AcademicYear;
use App\Services\AcademicYearService;
use Illuminate\Support\Facades\DB;

class AcademicYearImplement implements AcademicYearService
{
    public function get()
    {
        return AcademicYear::orderBy('name', 'asc')->get();
    }

    public function show($id)
    {
        return AcademicYear::findOrFail($id);
    }

    public function post($data)
    {
        if (!empty($data['is_active']) && $data['is_active'] == 1) {
            AcademicYear::query()->update([
                'is_active' => 0
            ]);
        }
        $academicYear = AcademicYear::create([
            'name' => $data['name'],
            'is_active' => $data['is_active'] ?? 0,
        ]);
        return $academicYear;
    }

    public function put($data)
    {
        return DB::transaction(function () use ($data) {
            $academicYear = AcademicYear::findOrFail($data['id']);
            if (($data['is_active'] ?? 0) == 0) {
                $activeCount = AcademicYear::where('is_active', 1)->count();
                if ($activeCount <= 1 && $academicYear->is_active == 1) {
                    throw new \Exception(
                        'At least one academic year must remain active.'
                    );
                }
            }
            if (($data['is_active'] ?? 0) == 1) {
                AcademicYear::where('id', '!=', $academicYear->id)
                    ->update([
                        'is_active' => 0
                    ]);
            }
            $academicYear->update([
                'name' => $data['name'],
                'is_active' => $data['is_active'] ?? 0,
            ]);
            return $academicYear->fresh();
        });
    }

    public function toggleActive($data)
    {
        $academicYear = AcademicYear::findOrFail($data->id);
        if ($data->is_active == 0) {
            $activeCount = AcademicYear::where('is_active', 1)->count();
            if ($activeCount <= 1 && $academicYear->is_active == 1) {
                throw new \Exception('At least one academic year must remain active.');
            }
            $academicYear->update([
                'is_active' => 0
            ]);
            return $academicYear->fresh();
        }
        AcademicYear::where('is_active', 1)->update(['is_active' => 0]);
        $academicYear->update([
            'is_active' => 1
        ]);
        return $academicYear->fresh();
    }

    public function delete($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        return $academicYear->delete();
    }
}
