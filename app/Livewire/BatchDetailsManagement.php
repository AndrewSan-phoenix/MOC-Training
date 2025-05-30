<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\BatchDetail;
use App\Models\Teacher;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BatchDetailsManagement extends Component
{
    use WithPagination;

    public $batches;
    public $teachers;
    public $lecturetitle;
    public $batchdetailsId = null;
    public $showModal = false;
    public $refreshKey = 0; // Used to force UI refresh

    #[Validate('required|exists:batches,id')]
    public $batch_id = '';

    #[Validate('required|exists:teachers,id')]
    public $teacher_id = '';

    #[Validate('required|date')]
    public $lecture_date = '';

    #[Validate('required|string|max:255')]
    public $lecture_title = '';

    public function mount()
    {
        $this->batches = Batch::with('course')->get(['id', 'name', 'course_id']);
        $this->teachers = Teacher::all(['id', 'name']);
    }

    public function updating($name)
    {
        if (in_array($name, ['batch_id', 'teacher_id', 'lecture_date', 'lecture_title'])) {
            $this->resetPage();
        }
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
            'teacher_id' => $this->teacher_id,
            'lecture_date' => $this->lecture_date,
            'lecture_title' => $this->lecture_title,
        ];
         $msg = $this->batchdetailsId ? 'Batch Details updated successfully!' : 'Batch Details created successfully!';

        if ($this->batchdetailsId) {
            $batchdetails = BatchDetail::findOrFail($this->batchdetailsId);
            $batchdetails->update($data);
        } else {
            BatchDetail::create($data);
        }

        $this->closeModal();
        $this->resetPage();
        $this->dispatch('notify', message: $msg);
    }

    #[On('edit-batchdetails')]
    public function edit($id)
    {
        $batchdetails = BatchDetail::findOrFail($id);
        $this->batchdetailsId = $batchdetails->id;
        $this->batch_id = $batchdetails->batch_id;
        $this->teacher_id = $batchdetails->teacher_id;
        $this->lecture_date = $batchdetails->lecture_date;
        $this->lecture_title = $batchdetails->lecture_title;
        $this->showModal = true;
    }

    #[On('delete-batchdetails')]
    public function delete($id)
    {
         $this->closeModal();
        $this->resetPage(); // Reset to first page after save
        $this->refreshKey++; // Force UI refresh
        $this->dispatch('notify', message: 'Batch deleted successfully!');
    }

    public function resetForm()
    {
        $this->batchdetailsId = null;
        $this->batch_id = '';
        $this->teacher_id = '';
        $this->lecture_date = '';
        $this->lecture_title = '';
        $this->resetValidation();
    }
public function export(): StreamedResponse
{
    $filename = 'batchdetails_' . now()->format('Y-m-d_H-i-s') . '.csv';

    return response()->streamDownload(function () {
        $handle = fopen('php://output', 'w');

        // Header row
        fputcsv($handle, [
            'ID',
            'Batch Name',
            'Teacher Name',
            'Lecture Date',
            'Lecture Title',
        ]);

        // Correct model: BatchDetail
        BatchDetail::with('batch', 'teacher')->cursor()->each(function ($batchdetails) use ($handle) {
            fputcsv($handle, [
                $batchdetails->id,
                optional($batchdetails->batch)->name,
                optional($batchdetails->teacher)->name,
                $batchdetails->lecture_date,
                $batchdetails->lecture_title,
            ]);
        });

        fclose($handle);
    }, $filename);
}


    public function render()
    {
        return view('livewire.batch-details-management', [
            'batchdetails' => BatchDetail::with('batch.course', 'teacher')->latest()->paginate(5),
            'refreshKey' => $this->refreshKey,

        ]);
    }
}
