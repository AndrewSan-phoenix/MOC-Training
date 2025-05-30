<?php

namespace App\Livewire\Dashboard;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;

class BatchChart extends Component
{
    public array $labels = [];
    public array $dataset = [];
    public array $teacherLabels = [];
    public array $teacherData = [];
    public array $studentLabels = [];
    public array $studentData = [];

    public function mount()
    {
        
        $batches = Batch::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        // Generate labels as "Batch Name (Course Name)"
        $this->labels = $batches->map(function ($batch) {
            return ' (' . ($batch->course ? $batch->course->name : 'N/A') . ')' . $batch->name;
        })->toArray();
        
        $this->dataset = [
            [
                'label' => 'Enrollments',
                'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1,
                'data' => $batches->pluck('enrollments_count')->toArray(),
            ],
        ];

        // //Teachers
        // $teachers = Teacher::all();
        // $this->teacherLabels = $teachers->pluck('name')->toArray();
        // $this->teacherData = $teachers->pluck('teachers_count')->toArray();

        // // Students
        // $students = Student::all();
        // $this->studentLabels = $students->pluck('batch.name')->toArray();
        // $this->studentData = $students->pluck('enrollments_count')->toArray();

       
    }

    public function render()
    {
        return view('livewire.dashboard.batch-chart');
    }
}


// namespace App\Livewire\Dashboard;

// use App\Models\Batch;
// use App\Models\Teacher;
// use App\Models\Student;
// use App\Models\Course;
// use Livewire\Component;

// class BatchChart extends Component
// {
//     public array $labels = [];
//     public array $dataset = [];
//     public array $teacherLabels = [];
//     public array $teacherData = [];
//     public array $studentLabels = [];
//     public array $studentData = [];
//     public array $courseLabels = [];
//     public array $courseData = [];

//     public function mount()
//     {
//         // Batches
//         $batches = Batch::withCount('students')
//             ->orderBy('students_count', 'desc')
//             ->take(5)
//             ->get();

//         $this->labels = $batches->pluck('name')->toArray();
//         $this->dataset = [
//             [
//                 'label' => 'Students',
//                 'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
//                 'borderColor' => 'rgba(54, 162, 235, 1)',
//                 'data' => $batches->pluck('students_count')->toArray(),
//             ],
//         ];

//         // Teachers
//         $teachers = Teacher::all();
//         $this->teacherLabels = $teachers->pluck('name')->toArray();
//         $this->teacherData = $teachers->pluck('students_count')->toArray();

//         // Students
//         $students = Student::all();
//         $this->studentLabels = $students->pluck('batch.name')->toArray();
//         $this->studentData = $students->pluck('enrollments_count')->toArray();

//         // Courses
//         $courses = Course::withCount('students')->get();
//         $this->courseLabels = $courses->pluck('name')->toArray();
//         $this->courseData = $courses->pluck('students_count')->toArray();
//     }

//     public function render()
//     {
//         return view('livewire.dashboard.batch-chart');
//     }
// }