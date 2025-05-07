<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class CourseManagement extends Component
{
    public $courses;
    public $courseId = null;
    public $showModal = false;

    #[Validate('required|string|max:255')]
    public $name = '';

    public function mount()
    {
        $this->loadCourses();
    }

    public function loadCourses()
    {
        $this->courses = Course::all();
    }

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

        $data = [
            'name' => $this->name,
        ];

        if ($this->courseId) {
            // Update existing course
            $course = Course::findOrFail($this->courseId);
            $course->update($data);
        } else {
            // Create new course
            Course::create($data);
        }

        $this->closeModal();
        $this->loadCourses();
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
        $this->loadCourses();
        $this->dispatch('notify', message: 'Course deleted successfully!');
    }

    public function resetForm()
    {
        $this->courseId = null;
        $this->name = '';
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.course-management');
    }
}
