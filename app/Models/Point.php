<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $guarded = ['id'];
    protected $with = ['member', 'house', 'academicYear'];
    protected $casts = [ 'date' => 'date'];

    public function member()
    {
        return $this->belongsTo(Member::class);
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
