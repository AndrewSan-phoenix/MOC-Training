<?php

namespace App\Livewire;

use App\Models\Gallery;
use App\Models\Batch;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

class GalleryManagement extends Component
{
    use WithFileUploads;

    // Remove $galleries from here, as it will hold a Paginator instance, which Livewire doesn't directly support as a public property for state.
    // public $galleries; // DELETE THIS LINE

    public $batches;
    public $filteredGalleries = null;
    public $galleryId = null;
    public $showModal = false;
    public $showbatch = false;
    public $searchBatchId = '';

    
    #[Validate('required|image|max:2048')]
    public $file;

    #[Validate('required|string|max:255')]
    public $description = '';

    #[Validate('required|exists:batches,id')]
    public $batch_id = '';

    public function mount()
    {
        // No need to load galleries here directly into a public property, render() will handle it.
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
        $this->validate();

        $fileName = $this->file->store('galleries', 'public');

        $data = [
            'file_name' => $fileName,
            'description' => $this->description,
            'batch_id' => $this->batch_id,
        ];

        if ($this->galleryId) {
            $gallery = Gallery::findOrFail($this->galleryId);
            $gallery->update($data);
        } else {
            Gallery::create($data);

        }

        $this->closeModal();
        // Dispatching notify message, render will automatically re-run and update the gallery list
        $this->dispatch('notify', message: $this->galleryId ? 'Gallery updated successfully!' : 'Gallery uploaded successfully!');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $this->galleryId = $gallery->id;
        $this->description = $gallery->description;
        $this->batch_id = $gallery->batch_id;
        $this->showModal = true;
    }

    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);
        if ($gallery->file_name && file_exists(public_path('storage/' . $gallery->file_name))) {
            unlink(public_path('storage/' . $gallery->file_name));
        }
        $gallery->delete();

        // Dispatching notify message, render will automatically re-run and update the gallery list
        $this->dispatch('notify', message: 'Gallery deleted successfully!');
    }

    public function resetForm()
    {
        $this->galleryId = null;
        $this->file = '';
        $this->description = '';
        $this->batch_id = '';
        $this->resetValidation();
    }

    

    public function render()
    {
        // Always eager load batch and course
        // Apply filtering by batch_id if searchBatchId is set
        // Limit the results by perPage
        $galleries = Gallery::with(['batch.course'])
            ->when(
                !empty($this->searchBatchId),
                fn($q) => $q->where('batch_id', $this->searchBatchId)
            )
            ->latest() // Order by latest to show new images first
            ->get(); // Use paginate to handle the limit and provide total count

        // For dropdown, eager load course for each batch
        $this->batches = \App\Models\Batch::with('course')->get();

        // Pass the paginator instance directly to the view
        return view('livewire.gallery-management', [
            'galleries' => $galleries,
        ]);
    }
}