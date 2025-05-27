<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Enroll;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Student;
use App\Models\Teacher; // Ensure this model is used
use App\Models\BatchTeacher; // Assuming you have a pivot model or a relation setup for teacher batches

class BrandingPageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function student(Request $request)
    {
        $allBatches = Batch::with('course')->orderBy('name')->get();
        return view('student', compact('allBatches'));
    }

    /**
     * Handles AJAX requests for paginated students.
     * Includes search/filter capabilities.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStudentsAjax(Request $request)
    {
        $page = max(1, (int) $request->input('page', 1));
        $search = trim($request->input('search', ''));
        $batchFilter = trim($request->input('batch_filter', 'all'));
        
        $studentsPerPageInitial = (int) $request->input('students_per_page', 6);
        $studentsPerPageSubsequent = (int) $request->input('subsequent_students_per_page', 6); // Changed to 6 for consistency

        $perPage = ($page === 1) ? $studentsPerPageInitial : $studentsPerPageSubsequent;

        $enrolledStudentIds = Enroll::distinct('student_id')->pluck('student_id');

        $query = Student::whereIn('id', $enrolledStudentIds)
            ->with('enrollments.batch.course');

        if (!empty($search)) {
            $searchLower = strtolower($search);
            $query->where(function ($q) use ($searchLower) {
                $q->whereRaw('LOWER(students.name) LIKE ?', ['%' . $searchLower . '%'])
                    ->orWhereHas('enrollments.batch', function ($qBatch) use ($searchLower) {
                        $qBatch->whereRaw('LOWER(batches.name) LIKE ?', ['%' . $searchLower . '%']);
                    })
                    ->orWhereHas('enrollments.batch.course', function ($qCourse) use ($searchLower) {
                        $qCourse->whereRaw('LOWER(courses.name) LIKE ?', ['%' . $searchLower . '%']);
                    });
            });
        }

        if ($batchFilter !== 'all') {
            $parts = explode(' - ', $batchFilter, 2);
            $courseName = trim($parts[0]);
            $batchName = isset($parts[1]) ? trim($parts[1]) : '';

            $query->whereHas('enrollments.batch', function ($qBatch) use ($courseName, $batchName) {
                $qBatch->whereRaw('LOWER(batches.name) = ?', [strtolower($batchName)]);
                $qBatch->whereHas('course', function ($qCourse) use ($courseName) {
                    $qCourse->whereRaw('LOWER(courses.name) = ?', [strtolower($courseName)]);
                });
            });
        }

        $students = $query->orderBy('name')->paginate($perPage, ['*'], 'page', $page);

        $data = $students->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name ?? 'N/A',
                'dob' => $student->dob,
                'phone' => $student->phone ?? 'N/A',
                'email' => $student->email ?? 'N/A',
                'profile_image' => $student->profile_image ? asset('storage/' . $student->profile_image) : asset('images/default-profile.png'),
                'batches_data' => $student->enrollments->map(function ($enrollment) {
                    return ($enrollment->batch->course->name ?? 'No Course') . ' - ' . ($enrollment->batch->name ?? 'No Batch');
                })->join(';'),
            ];
        })->toArray();

        return response()->json([
            'data' => $data,
            'current_page' => $students->currentPage(),
            'last_page' => $students->lastPage(),
            'per_page' => $students->perPage(),
            'total' => $students->total(),
        ]);
    }

    // New method for AJAX teacher data
    public function getTeachersAjax(Request $request)
    {
        $page = max(1, (int) $request->input('page', 1));
        $search = trim($request->input('search', ''));
        $batchFilter = trim($request->input('batch_filter', 'all'));
        
        // Define pagination sizes for teachers (adjust as needed)
        $teachersPerPage = (int) $request->input('teachers_per_page', 4); // Display 4 teachers per page

        $query = Teacher::with('batchDetails.batch.course');

        if (!empty($search)) {
            $searchLower = strtolower($search);
            $query->where(function ($q) use ($searchLower) {
                $q->whereRaw('LOWER(teachers.name) LIKE ?', ['%' . $searchLower . '%'])
                    ->orWhereRaw('LOWER(teachers.position) LIKE ?', ['%' . $searchLower . '%']) // Search by position
                    ->orWhereHas('batchDetails.batch', function ($qBatch) use ($searchLower) {
                        $qBatch->whereRaw('LOWER(batches.name) LIKE ?', ['%' . $searchLower . '%']);
                    })
                    ->orWhereHas('batchDetails.batch.course', function ($qCourse) use ($searchLower) {
                        $qCourse->whereRaw('LOWER(courses.name) LIKE ?', ['%' . $searchLower . '%']);
                    });
            });
        }

        if ($batchFilter !== 'all') {
            $parts = explode(' - ', $batchFilter, 2);
            $courseName = trim($parts[0]);
            $batchName = isset($parts[1]) ? trim($parts[1]) : '';

            $query->whereHas('batchDetails.batch', function ($qBatch) use ($courseName, $batchName) {
                $qBatch->whereRaw('LOWER(batches.name) = ?', [strtolower($batchName)]);
                $qBatch->whereHas('course', function ($qCourse) use ($courseName) {
                    $qCourse->whereRaw('LOWER(courses.name) = ?', [strtolower($courseName)]);
                });
            });
        }

        $teachers = $query->orderBy('name')->paginate($teachersPerPage, ['*'], 'page', $page);

        $data = $teachers->map(function ($teacher) {
            $batchDetails = $teacher->batchDetails;
            $uniqueBatches = $batchDetails->pluck('batch_id')->unique()->count();

            $batchIds = $batchDetails->pluck('batch_id')->unique();
            $studentTotal = Enroll::whereIn('batch_id', $batchIds)->distinct('student_id')->count();

            $batchesData = $batchDetails->map(function ($bd) {
                return ($bd->batch->course->name ?? 'No Course') . ' - ' . ($bd->batch->name ?? 'No Batch');
            })->unique()->join(';'); // Join unique batch strings with semicolon

            return [
                'id' => $teacher->id,
                'name' => $teacher->name ?? 'N/A',
                'position' => $teacher->position ?? 'N/A',
                'organization' => $teacher->organization ?? 'N/A',
                'phone' => $teacher->phone ?? 'N/A',
                'email' => $teacher->email ?? 'N/A',
                'profile_image' => $teacher->profile_image ? asset('storage/' . $teacher->profile_image) : asset('images/default-profile.png'),
                'unique_batches_count' => $uniqueBatches,
                'total_students_taught' => $studentTotal,
                'batches_data' => $batchesData, // String of "Course - Batch" for filtering
            ];
        })->toArray();

        return response()->json([
            'data' => $data,
            'current_page' => $teachers->currentPage(),
            'last_page' => $teachers->lastPage(),
            'per_page' => $teachers->perPage(),
            'total' => $teachers->total(),
        ]);
    }


    public function teacher()
    {
        // For initial page load, we just need all batches for the dropdown
        $allBatches = Batch::with('course')->orderBy('name')->get();
        return view('teacher', compact('allBatches'));
    }

    public function course()
    {
        $courses = Course::withCount('batches')->get();
        return view('course', compact('courses'));
    }

    public function galleries(Request $request)
    {
        if ($request->ajax()) {
            $galleries = Gallery::with('batch.course')->simplePaginate(6);
            return response()->json($galleries);
        }
        $galleries = Gallery::with('batch.course')->paginate(6);
        $batches = Batch::with('course', 'galleries')->get();
        return view('gallery', compact('galleries', 'batches'));
    }

    public function batch()
    {
        $batches = Batch::with('course', 'batchDetails.teacher')->orderBy('start_date', 'desc')->get();
        return view('batch', compact('batches'));
    }
}