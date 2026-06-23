<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $guarded = ['id'];
    protected $with = ['member', 'house', 'academicYear'];
    protected $casts = [ 'date' => 'date'];

}
