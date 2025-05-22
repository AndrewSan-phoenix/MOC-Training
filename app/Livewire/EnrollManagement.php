<?php

namespace App\Livewire;
use Symfony\Component\HttpFoundation\StreamedResponse; // Make sure this is at the top with your other use statements

use App\Models\Batch;
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
    public $showModal = false;

    #[Validate('required|exists:batches,id')]
    public $batch_id = '';

    #[Validate('required|exists:students,id')]
    public $student_id = '';

    #[Validate('required|date')]
    public $enroll_date = '';

    public function mount()
    {
        $this->batches = Batch::all(['id', 'name']);
        $this->students = Student::all(['id', 'name']);
    }

    public function updating()
    {
        $this->resetPage();
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
            Enroll::findOrFail($this->enrollId)->update($data);
        } else {
            Enroll::create($data);
        }

        $this->closeModal();
        $this->dispatch('notify', message: $this->enrollId ? 'Enrollment updated successfully!' : 'Enrollment created successfully!');
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
    
// public function export(): StreamedResponse
// {
//     $filename = 'enrolls_' . now()->format('Y-m-d_H-i-s') . '.csv';

//     return response()->streamDownload(function () {
//         $handle = fopen('php://output', 'w');

//         // Header row
//         fputcsv($handle, [
//             'ID',
//             'Batch Name',
//             'Student Name',
//             'Enroll Date',
//         ]);

//         // Batch rows
//         Enroll::with('enroll')->cursor()->each(function ($enroll) use ($handle) {
//             fputcsv($handle, [
//                 $enroll->id,
//                 optional($enroll->batch)->name,
//                 optional($enroll->student)->name,
//                 $enroll->enroll_date,            
//             ]);
//         });

//         fclose($handle);
//     }, $filename);
// }

    public function render()
    {
        return view('livewire.enroll-management', [
            'enrollments' => Enroll::with(['batch', 'student'])->paginate(5),
        ]);
    }
}
