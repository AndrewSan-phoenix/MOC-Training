<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = ['name', 'course_id', 'timetable', 'start_date', 'end_date', 'fees'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
public function students()
{
    return $this->hasMany(Student::class);
}

    public function enrollments()
    {
        return $this->hasMany(Enroll::class);
    }

    public function batchDetails()
    {
        return $this->hasMany(BatchDetail::class);
    }


    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}