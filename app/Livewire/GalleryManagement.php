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

    public $galleries;
    public $batches;
    public $filteredGalleries=null;
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
        $this->loadGalleries();
        $this->batches = Batch::all(['id', 'name']);
    }

    public function loadGalleries()
    {
        $this->galleries = Gallery::with('batch')->get();
        
        
  
    }
    public function openbatch()
    {
        if ($this->searchBatchId !== '' && $this->batch_id==$this->searchBatchId) {
            $this->showbatch = true;
            $this->galleries = Gallery::where('batch_id', $this->searchBatchId)->with('batch')->get();
        } else {
            $this->loadGalleries();
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
        $this->loadGalleries();
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

        $this->loadGalleries();
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
        $this->galleries = Gallery::with('batch')->get();
        $query = Gallery::query();
        if (!empty($this->searchBatchId)) {
               $query->where('batch_id', $this->searchBatchId);
               $this->galleries = Gallery::where('batch_id',$this->searchBatchId)->get();
           }
           
        return view('livewire.gallery-management');
    }
}
