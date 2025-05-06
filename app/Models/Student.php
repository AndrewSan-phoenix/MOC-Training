<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'dob', 'gender', 'nrc', 'phone', 'email', 'address'];

    public function enrollments()
    {
        return $this->hasMany(Enroll::class);
    }
}
