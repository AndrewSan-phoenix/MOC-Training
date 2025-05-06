<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'position', 'organization', 'dob', 'gender', 'nrc', 'phone', 'email', 'address'];

    public function batchDetails()
    {
        return $this->hasMany(BatchDetail::class);
    }
}
