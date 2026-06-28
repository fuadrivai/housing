<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = ['id'];
    protected $with = ['person', 'academicYear'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function person()
    {
        return $this->belongsTo(People::class, 'people_id');
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
