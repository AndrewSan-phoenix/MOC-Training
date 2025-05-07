<?php

namespace App\Livewire;

use App\Models\Enroll;
use App\Models\Batch;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class EnrollManagement extends Component
{
    public $enrollments;
    public $batches;
    public $students;
    public $enrollId = null;
    public $showModal = false;

    #[Validate('required|exists:batches,id')]
    public $batch_id = '';

    #[Validate('required|exists:students,id')]
    public $student_id = '';

    #[Validate('required|date')]
    public $enroll_date = '';

    public function mount()
    {
        $this->loadEnrollments();
        $this->batches = Batch::all(['id', 'name']);
        $this->students = Student::all(['id', 'name']);
    }

    public function loadEnrollments()
    {
        $this->enrollments = Enroll::with(['batch', 'student'])->get();
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
            'batch_id' => $this->batch_id,
            'student_id' => $this->student_id,
            'enroll_date' => $this->enroll_date,
        ];

        if ($this->enrollId) {
            // Update existing enrollment
            $enrollment = Enroll::findOrFail($this->enrollId);
            $enrollment->update($data);
        } else {
            // Create new enrollment
            Enroll::create($data);
        }

        $this->closeModal();
        $this->loadEnrollments();
        $this->dispatch('notify', message: $this->enrollId ? 'Enrollment updated successfully!' : 'Enrollment created successfully!');
    }

    #[On('edit-enroll')]
    public function edit($id)
    {
        $enrollment = Enroll::findOrFail($id);
        $this->enrollId = $enrollment->id;
        $this->batch_id = $enrollment->batch_id;
        $this->student_id = $enrollment->student_id;
        $this->enroll_date = $enrollment->enroll_date;
        $this->showModal = true;
    }

    #[On('delete-enroll')]
    public function delete($id)
    {
        Enroll::findOrFail($id)->delete();
        $this->loadEnrollments();
        $this->dispatch('notify', message: 'Enrollment deleted successfully!');
    }

    public function resetForm()
    {
        $this->enrollId = null;
        $this->batch_id = '';
        $this->student_id = '';
        $this->enroll_date = '';
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.enroll-management');
    }
}
