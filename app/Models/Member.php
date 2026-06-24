<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = ['id'];
    protected $with = ['person', 'academicYear'];

    public function person()
    {
        return $this->hasOne(People::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
