<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Student;
use App\Models\Teacher;

class BrandingPageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }


public function student(Request $request)
{
     
    if ($request->ajax()) {
            $students = Student::with('enrollments.batch.course')->paginate(6);
            return response()->json($students);
        }
            $students = Student::with('enrollments.batch.course')->paginate(6);

    // Eager load course for each batch for the dropdown
    $allBatches = \App\Models\Batch::with('course')->orderBy('name')->get();

    return view('student', compact('students', 'allBatches'));
}

    public function teacher()
    {
        $teachers = Teacher::with('batchDetails.batch.course')->get();

        foreach ($teachers as $teacher) {
            $teacher->unique_batches = $teacher->batchDetails->pluck('batch_id')->unique()->count();
            $batchIds = $teacher->batchDetails->pluck('batch_id')->unique();
            $teacher->student_total = \App\Models\Enroll::whereIn('batch_id', $batchIds)->pluck('student_id')->unique()->count();
        }
        $allBatches = \App\Models\Batch::with('course')->orderBy('name')->get();
        return view('teacher', compact('teachers', 'allBatches'));
    }

    public function course()
{
    // Fetch all courses with the number of active batches
    $courses = Course::withCount('batches')->get(); // This will add 'batches_count' attribute

    return view('course', compact('courses'));
}

 public function galleries(Request $request)
    {
        if ($request->ajax()) {
            // For AJAX requests, paginate galleries
            $galleries = Gallery::with('batch.course')->paginate(6);
            return response()->json($galleries);
        }
        $galleries = Gallery::with('batch.course')->paginate(6); 
        $batches = Batch::with('course', 'galleries')->get();
        return view('gallery', compact('galleries', 'batches'));
    }


public function batch()
{
    $batches = \App\Models\Batch::with('course', 'batchDetails.teacher')->orderBy('start_date', 'desc')->get();
    return view('batch', compact('batches'));
}
}