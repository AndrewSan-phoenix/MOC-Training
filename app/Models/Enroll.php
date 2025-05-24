<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Enroll extends Model
    {
        protected $fillable = ['batch_id', 'student_id', 'enroll_date','course_id'];
        protected $table = 'enroll';

        public function student()
        {
            return $this->belongsTo(Student::class);
        }

        public function batch()
        {
            return $this->belongsTo(Batch::class);
        }
         public function course()
        {
            return $this->belongsTo(Course::class);
        }
 
public function getBatchCourseAttribute()
{
    return ($this->batch->course->name ?? 'No Course') . ' - ' . ($this->batch->name ?? 'N/A');
}
    }
