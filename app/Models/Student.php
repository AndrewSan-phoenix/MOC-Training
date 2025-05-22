<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

protected $fillable = ['name', 'dob', 'gender', 'nrc', 'phone', 'email', 'address', 'profile_image'];


   

    public function enrollments()
    {
        return $this->hasMany(Enroll::class);
    }
    // In Student model
public function getGenderLabelAttribute()
{
    return match($this->gender) {
        1 => 'Male',
        2 => 'Female',
        3 => 'Other',
        default => 'Unknown',
    };
}

}
