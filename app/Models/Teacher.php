<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Teacher extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'profile_image',
        'organization',
        'dob',
        'gender',      // <-- add this
        'nrc',         // <-- and any other fields you use
    ];

    public function batchDetails()
    {
        return $this->hasMany(BatchDetail::class);
    }

    public function getGenderLabelAttribute()
    {
        return match((string)$this->gender) {
            '1' => 'Male',
            '2' => 'Female',
            '3' => 'Other',
            default => 'Unknown',
        };
    }
}