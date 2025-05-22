@props([])


<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-6 font-bold text-primary">Gallery Management</h1>

    <!-- Notification -->
    <div x-data="{ message: '' }" x-init="window.addEventListener('notify', event => {
        message = event.detail.message;
        setTimeout(() => message = '', 3000);
    });">
        <div x-show="message" x-transition class="bg-info text-light p-4 rounded-md mb-4" x-text="message"></div>
    </div>

    <!-- Add Gallery Button -->
    <div class="mb-6">
        <button wire:click="openModal"
            class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
            Add Gallery Image
        </button>
    </div>

    <!-- Modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-cloak
        class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-light rounded-md p-6 w-full max-w-xl max-h-[80vh] overflow-y-auto">
            <h2 class="text-xl text-primary mb-4">{{ $galleryId ? 'Edit Gallery' : 'Upload Gallery Image' }}</h2>
            <form wire:submit.prevent="save" enctype="multipart/form-data">
                <div class="space-y-4">
                    <div>
                        <label for="file" class="block font-medium">Image</label>
                        <input wire:model="file" id="file" type="file" accept="image/*"
                            class="w-full border border-gray-300 rounded-md p-2">
                        @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="description" class="block font-medium">Description</label>
                        <input wire:model="description" id="description" type="text"
                            class="w-full border border-gray-300 rounded-md p-2">
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="batch_id" class="block font-medium">Batch</label>
                        <select wire:model="batch_id" id="batch_id"
                            class="w-full border border-gray-300 rounded-md p-2">
                            <option value="">Select Batch</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                        @error('batch_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-4 flex justify-end gap-4">
                    <button type="submit"
                        class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
                        {{ $galleryId ? 'Update' : 'Upload' }}
                    </button>
                    <button type="button" @click="open = false" wire:click="closeModal"
                        class="bg-gray-500 text-light px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>



  <!-- Dropdown menu -->
 

<select name="batch" id="batch" wire:model.live="searchBatchId">
    @foreach($batches as $batch)
        <option value="{{ $batch->id }}">{{ $batch->name }}</option>
    @endforeach
   
</select>


    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($galleries as $gallery)
            <div class="bg-white rounded-lg shadow-md overflow-hidden relative group">
                <!-- Image -->
                <img src="{{ asset('storage/' . $gallery->file_name) }}" alt="Gallery Image"
                    class="w-full h-48 object-cover transition-all duration-300 group-hover:opacity-50">

                <!-- Hover Details -->
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-70 transition-opacity duration-300 flex flex-col justify-between p-4">
                    
                    <div class="mt-2 flex justify-content-end justify-end gap-2">
                        <button wire:click="edit({{$gallery->id}})"
                            class="bg-green-500 text-light px-3 py-1 rounded-md hover:bg-black transition-colors">
                            <!-- Edit Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>
                        </button>
                        <button wire:click="delete({{$gallery->id}})"
                            onclick="return confirm('Are you sure you want to delete this image?')"
                            class="bg-red-500 text-light px-3 py-1 rounded-md hover:bg-dark transition-colors">
                            <!-- Delete Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-2 flex flex-col items-center justify-center">
                        
                    <p class="text-gray-100 font-semibold">{{ $gallery->description }}</p>
                        <p class="text-sm text-gray-300">Batch: {{ $gallery->batch->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">No gallery images found.</p>

        @endforelse
    </div>
<!-- Load More Button -->

</div>
