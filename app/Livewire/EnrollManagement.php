<?php

namespace App\Livewire;

use Symfony\Component\HttpFoundation\StreamedResponse; // Make sure this is at the top with your other use statements
use App\Models\Batch;
use App\Models\Course; // Assuming you might use it, though not directly in this corrected version's save logic
use App\Models\Enroll;
use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollManagement extends Component
{
    use WithPagination;

    public $batches, $students;
    public $enrollId = null;
    public $refreshKey = 0; // Used to force UI refresh
    public $showModal = false;


    #[Validate('required|exists:batches,id')]
    public $batch_id = '';

    #[Validate('required|exists:students,id')]
    public $student_id = '';

    #[Validate('required|date')]
    public $enroll_date = '';

    public function mount()
    {
        // Eager load course relationship for batches to get course_id and name
        $this->batches = Batch::with('course')->get(['id', 'name', 'course_id']);
        $this->students = Student::all(['id', 'name']);
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->resetForm(); // Reset form when opening for a new entry
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

        // Get the selected batch and its course_id
        $batch = Batch::find($this->batch_id);
        if (!$batch) {
            $this->addError('batch_id', 'Selected batch does not exist.');
            return;
        }
        $courseId = $batch->course_id;

        // Check if the student is already enrolled in any batch of this course
        $alreadyEnrolled = Enroll::where('student_id', $this->student_id)
            ->whereHas('batch', function ($q) use ($courseId) {
                $q->where('course_id', $courseId);
            })
            ->when($this->enrollId, fn($q) => $q->where('id', '!=', $this->enrollId))
            ->exists();

        if ($alreadyEnrolled) {
            $this->addError('student_id', 'This student is already enrolled in a batch for this course.');
            return;
        }

        $data = [
            'batch_id' => $this->batch_id,
            'student_id' => $this->student_id,
            'enroll_date' => $this->enroll_date,
            'course_id' => $courseId, // Only if your enrolls table has this column
        ];

        if ($this->enrollId) {
            Enroll::findOrFail($this->enrollId)->update($data);
            $this->dispatch('notify', message: 'Enrollment updated successfully!');
        } else {
            Enroll::create($data);
            $this->dispatch('notify', message: 'Enrollment created successfully!');
        }

        $this->closeModal();
        $this->resetPage(); // Reset to first page after save
        $this->refreshKey++; // Force UI refresh

    }

    #[On('edit-enroll')]
    public function edit($id)
    {
        $enroll = Enroll::findOrFail($id);
        $this->enrollId = $enroll->id;
        $this->batch_id = $enroll->batch_id;
        $this->student_id = $enroll->student_id;
        $this->enroll_date = $enroll->enroll_date;
        $this->showModal = true;
    }

    #[On('delete-enroll')]
    public function delete($id)
    {
        Enroll::findOrFail($id)->delete();
         $this->closeModal();
        $this->resetPage(); // Reset to first page after save
        $this->refreshKey++; // Force UI refresh

        $this->dispatch('notify', message: 'Enrollment deleted successfully!');
    }

    public function resetForm()
    {
        $this->enrollId = null;
        $this->batch_id = '';
        $this->student_id = '';
        $this->enroll_date = '';
        $this->resetValidation(); // Clear validation errors
    }

    public function export(): StreamedResponse
    {
        $filename = 'enrolls_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');

            // Header row
            fputcsv($handle, [
                'ID',
                'Course Name',
                'Batch Name',
                'Student Name',
                'Enroll Date',
            ]);

            // Data rows
            // Corrected: Eager load necessary relations for export
            Enroll::with(['batch.course', 'student'])->cursor()->each(function ($enroll) use ($handle) {
                fputcsv($handle, [
                    $enroll->id,
                    optional(optional($enroll->batch)->course)->name, // Safely access course name
                    optional($enroll->batch)->name,
                    optional($enroll->student)->name,
                    $enroll->enroll_date,
                ]);
            });

            fclose($handle);
        }, $filename);
    }

    public function render()
    {
        // Eager load batch.course for table display
        return view('livewire.enroll-management', [
            'enrollments' => Enroll::with(['batch.course', 'student'])->latest()->paginate(5),
            'refreshKey' => $this->refreshKey,
        ]);
    }
}