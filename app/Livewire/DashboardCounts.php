<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Batch;
use App\Models\Course;

class DashboardCounts extends Component
{
    public $totalUsers;
    public $totalTeachers;
    public $totalStudents;
    public $totalBatches;
    public $totalCourses;

    public function mount()
    {
        // Fetch counts when the component is initialized
        $this->totalUsers = User::count();
        $this->totalTeachers = Teacher::count();
        $this->totalStudents = Student::count();
        $this->totalBatches = Batch::count();
        $this->totalCourses = Course::count();
    }

    public function render()
    {
        return view('livewire.dashboard-counts');
    }
}