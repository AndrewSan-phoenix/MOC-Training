<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchDetail extends Model
{
    protected $fillable = ['batch_id', 'teacher_id', 'lecture_date', 'lecture_title'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}