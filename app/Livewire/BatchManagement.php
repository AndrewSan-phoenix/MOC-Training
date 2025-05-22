<?php

namespace App\Livewire;
use Symfony\Component\HttpFoundation\StreamedResponse; // Make sure this is at the top with your other use statements

use App\Models\Batch;
use App\Models\Course;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class BatchManagement extends Component
{
    use WithPagination;

    public $courses;
    public $batchId = null;
    public $showModal = false;

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|exists:courses,id')]
    public $course_id = '';

    #[Validate('required|string|max:255')]
    public $timetable = '';

    #[Validate('required|date')]
    public $start_date = '';

    #[Validate('required|date|after_or_equal:start_date')]
    public $end_date = '';

    #[Validate('required|numeric|min:0')]
    public $fees = '';

    public function mount()
    {
        $this->courses = Course::all(['id', 'name']);
    }

    public function updating()
    {
        $this->resetPage(); // Reset pagination when updated
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
            'course_id' => $this->course_id,
            'timetable' => $this->timetable,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'fees' => $this->fees,
        ];

        if ($this->batchId) {
            Batch::findOrFail($this->batchId)->update($data);
        } else {
            Batch::create($data);
        }

        $this->closeModal();
        $this->dispatch('notify', message: $this->batchId ? 'Batch updated successfully!' : 'Batch created successfully!');
    }

    #[On('edit-batch')]
    public function edit($id)
    {
        $batch = Batch::findOrFail($id);
        $this->batchId = $batch->id;
        $this->name = $batch->name;
        $this->course_id = $batch->course_id;
        $this->timetable = $batch->timetable;
        $this->start_date = $batch->start_date;
        $this->end_date = $batch->end_date;
        $this->fees = $batch->fees;
        $this->showModal = true;
    }

    #[On('delete-batch')]
    public function delete($id)
    {
        Batch::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Batch deleted successfully!');
    }

    public function resetForm()
    {
        $this->batchId = null;
        $this->name = '';
        $this->course_id = '';
        $this->timetable = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->fees = '';
        $this->resetValidation();
    }

public function export(): StreamedResponse
{
    $filename = 'batches_' . now()->format('Y-m-d_H-i-s') . '.csv';

    return response()->streamDownload(function () {
        $handle = fopen('php://output', 'w');

        // Header row
        fputcsv($handle, [
            'ID',
            'Name',
            'Course',
            'Timetable',
            'Start Date',
            'End Date',
            'Fees',
        ]);

        // Batch rows
        Batch::with('course')->cursor()->each(function ($batch) use ($handle) {
            fputcsv($handle, [
                $batch->id,
                $batch->name,
                optional($batch->course)->name,
                $batch->timetable,
                $batch->start_date,
                $batch->end_date,
                $batch->fees,
            ]);
        });

        fclose($handle);
    }, $filename);
}

    
    public function render()
    {
        return view('livewire.batch-management', [
            'batches' => Batch::with('course')->paginate(5),
        ]);
    }
    
}
