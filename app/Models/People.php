<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $guarded = ['id'];
    protected $with = ['organization', 'branch'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'people_id');
    }
}
