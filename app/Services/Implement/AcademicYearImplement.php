<?php

namespace App\Services\Implement;

use App\Models\AcademicYear;
use App\Services\AcademicYearService;
use Illuminate\Support\Facades\Storage;

class AcademicYearImplement implements AcademicYearService
{
    public function get()
    {
        return AcademicYear::all();
    }
    public function show($id)
    {
        return AcademicYear::findOrFail($id);
    }

    public function post($data)
    {
        $academicYear = AcademicYear::create([
            'name' => $data['name'],
            'is_active' => $data['is_active']?? 0,
        ]);

        return $academicYear;
    }

    public function put($data)
    {
        $academicYear = AcademicYear::findOrFail($data->id);
        $academicYear->update([
            'name' => $data->name,
            'is_active' => $data->is_active ?? 0,
        ]);
        return $academicYear->fresh();
    }

    public function delete($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        return $academicYear->delete();
    }
}
