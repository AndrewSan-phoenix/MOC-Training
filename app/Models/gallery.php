<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['file_name', 'description', 'batch_id'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
} 