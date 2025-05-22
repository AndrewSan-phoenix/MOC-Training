<?php

namespace App\Livewire;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse; // Make sure this is at the top with your other use statements

use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\Course;

class CourseManagement extends Component
{
    use WithPagination;

    public $courseId = null;
    public $showModal = false;

    #[Validate('required|string|max:255')]
    public $name = '';

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function save()
    {
        $this->validate();

        $data = ['name' => $this->name];

        if ($this->courseId) {
            $course = Course::findOrFail($this->courseId);
            $course->update($data);
        } else {
            Course::create($data);
        }

        $this->closeModal();
        $this->dispatch('notify', message: $this->courseId ? 'Course updated successfully!' : 'Course created successfully!');
    }

    #[On('edit-course')]
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $this->courseId = $course->id;
        $this->name = $course->name;
        $this->showModal = true;
    }

    #[On('delete-course')]
    public function delete($id)
    {
        Course::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Course deleted successfully!');
    }

    public function resetForm()
    {
        $this->courseId = null;
        $this->name = '';
        $this->resetValidation();
    }
public function export(): StreamedResponse
{
    $filename = 'courses_' . now()->format('Y-m-d_H-i-s') . '.csv';

    return response()->streamDownload(function () {
        $handle = fopen('php://output', 'w');

        // Header row
        fputcsv($handle, [
            'ID',
            'Name',
        ]);

        // Batch rows
        Course::with('course')->cursor()->each(function ($course) use ($handle) {
            fputcsv($handle, [
                $course->id,
                $course->name,
              
            ]);
        });

        fclose($handle);
    }, $filename);
}

    public function render()
    {
        $courses = Course::paginate(5);
        $data = $courses->items();

        return view('livewire.course-management', compact('courses', 'data'));
    }
}
