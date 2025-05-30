<?php

namespace App\Livewire;

use App\Models\Gallery;
use App\Models\Batch;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; // No need for #[Validate] on properties directly anymore for $file
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class GalleryManagement extends Component
{
    use WithFileUploads;

    public $batches;
    public $filteredGalleries = null;
    public $galleryId = null;
    public $showModal = false;
    public $showbatch = false; // This property seems unused, consider removing if not needed.
    public $searchBatchId = '';

    public $file; // Will hold the new file upload
    public $description = '';
    public $batch_id = '';
    public $currentImage = null; // To store the path of the existing image for display

    public function mount()
    {
        $this->batches = Batch::all(['id', 'name']);
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
        $rules = [
            'description' => 'required|string|max:255',
            'batch_id' => 'required|exists:batches,id',
        ];

        // Conditionally apply file validation: required only for new records
        if (!$this->galleryId) {
            $rules['file'] = 'required|image|max:2048';
        } else {
            // For updates, if a file is provided, validate it
            $rules['file'] = 'nullable|image|max:2048';
        }

        $this->validate($rules);

        $data = [
            'description' => $this->description,
            'batch_id' => $this->batch_id,
        ];

        $msg = $this->galleryId ? 'Gallery updated successfully!' : 'Gallery uploaded successfully!';

        if ($this->galleryId) {
            $gallery = Gallery::findOrFail($this->galleryId);

            // If a new file is uploaded, store it and update file_name
            if ($this->file) {
                // Delete old file if it exists
                if ($gallery->file_name && Storage::disk('public')->exists($gallery->file_name)) {
                    Storage::disk('public')->delete($gallery->file_name);
                }
                $data['file_name'] = $this->file->store('galleries', 'public');
            }
            // If no new file is uploaded, the file_name remains the same (not updated in $data)

            $gallery->update($data);
        } else {
            // This is a new record, so file is required
            $data['file_name'] = $this->file->store('galleries', 'public');
            Gallery::create($data);
        }

        $this->closeModal();
        $this->dispatch('notify', message: $msg);
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $this->galleryId = $gallery->id;
        $this->description = $gallery->description;
        $this->batch_id = $gallery->batch_id;
        $this->currentImage = $gallery->file_name; // Set the current image path for display
        $this->showModal = true;
    }

    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);
        // Use Storage facade for consistency and error handling
        if ($gallery->file_name && Storage::disk('public')->exists($gallery->file_name)) {
            Storage::disk('public')->delete($gallery->file_name);
        }
        $gallery->delete();

        $this->dispatch('notify', message: 'Gallery deleted successfully!');
    }

    public function resetForm()
    {
        $this->galleryId = null;
        $this->file = null; // Reset file input
        $this->description = '';
        $this->batch_id = '';
        $this->currentImage = null; // Clear current image preview
        $this->resetValidation();
    }

    public function render()
    {
        $galleries = Gallery::with(['batch.course'])
            ->when(
                !empty($this->searchBatchId),
                fn($q) => $q->where('batch_id', $this->searchBatchId)
            )
            ->latest()
            ->get();

        $this->batches = \App\Models\Batch::with('course')->get();

        return view('livewire.gallery-management', [
            'galleries' => $galleries,
        ]);
    }
}