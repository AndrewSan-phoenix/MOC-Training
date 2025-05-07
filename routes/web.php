<?php
use  App\Livewire\Student\StudentIndex;
use App\Livewire\Student\StudentCreate;
use App\Livewire\Student\StudentEdit;
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

    Route::get("/student",StudentIndex::class)->name("student.index");
    Route::get("/student/create",StudentCreate::class)->name("student.create");
    Route::get("/student/{id}/edit",StudentEdit::class)->name("student.edit");
    

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
