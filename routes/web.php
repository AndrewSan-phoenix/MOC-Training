<?php

use App\Livewire\BatchManagement;
use App\Livewire\CourseManagement;
use App\Livewire\EnrollManagement;
use  App\Livewire\Student\StudentIndex;
use App\Livewire\Student\StudentCreate;
use App\Livewire\Student\StudentEdit;
use App\Livewire\StudentManagement;
use App\Livewire\TeacherManagement;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    // Route::get("/student",StudentIndex::class)->name("student.index");
    Route::get("/student/create",StudentCreate::class)->name("student.create");
    Route::get("/student/{id}/edit",StudentEdit::class)->name("student.edit");
    Route::get("/student",StudentManagement::class)->name("student");

    Route::get("/teacher",TeacherManagement::class)->name("teacher");
    Route::get("/batch",BatchManagement::class)->name("batch");
    Route::get("/course",CourseManagement::class)->name("course");
    Route::get("/enroll",EnrollManagement::class)->name("enroll");


    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
