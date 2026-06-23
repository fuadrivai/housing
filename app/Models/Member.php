<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = ['id'];
    protected $with = ['person', 'house', 'organization', 'branch', 'academicYear'];

    public function person()
    {
        return $this->belongsTo(People::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
