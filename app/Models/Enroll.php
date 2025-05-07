<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Enroll extends Model
    {
        protected $fillable = ['batch_id', 'student_id', 'enroll_date'];
        protected $table = 'enroll';

        public function student()
        {
            return $this->belongsTo(Student::class);
        }

        public function batch()
        {
            return $this->belongsTo(Batch::class);
        }
    }
