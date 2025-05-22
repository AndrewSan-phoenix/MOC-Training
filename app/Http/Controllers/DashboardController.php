<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;




class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalBatches = Batch::count();
        $totalCourses = Course::count();
        $totalEnrollments = Enroll::count();

        return view('dashboard', compact('totalUsers', 'totalStudents', 'totalTeachers', 'totalBatches', 'totalCourses','totalEnrollments'));
    }




}
