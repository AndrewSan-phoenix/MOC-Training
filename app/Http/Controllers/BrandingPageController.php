<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use App\Models\Teacher;

class BrandingPageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function student()
    {
        // Eager load enrolls for each student
        $students = Student::with('enrollments')->get();
        
         $allBatches =Batch::orderBy('name')->get();
        return view('student', compact('students', 'allBatches'));
    }

    public function teacher()
    {
        $teachers = Teacher::with('batchDetails.batch')->paginate(4);

        foreach ($teachers as $teacher) {
            $teacher->unique_batches = $teacher->batchDetails->pluck('batch_id')->unique()->count();
            $batchIds = $teacher->batchDetails->pluck('batch_id')->unique();
            $teacher->student_total = \App\Models\Enroll::whereIn('batch_id', $batchIds)->pluck('student_id')->unique()->count();
        }

        $allBatches = \App\Models\Batch::orderBy('name')->get();

        return view('teacher', compact('teachers', 'allBatches'));
    }

    public function course()
    {
        return view('course');
    }

    public function galleries()
    {
        $batches = Batch::with('galleries')->get();
        return view('gallery', compact('batches'));
    }

  
public function batch()
{
    $batches = \App\Models\Batch::with('course')->orderBy('start_date', 'desc')->get();
    return view('batch', compact('batches'));
}
}