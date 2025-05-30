@props([])

<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-6">Course Management</h1>

    <!-- Notification -->
    <div x-data="{ message: '' }" x-init="
        window.addEventListener('notify', event => {
            message = event.detail.message;
            setTimeout(() => message = '', 3000);
        });
    ">
        <div x-show="message" x-transition class="bg-info text-light p-4 rounded-md mb-4" x-text="message"></div>
    </div>

    <!-- Add Course Button -->
    <div class="mb-6">
        <button wire:click="openModal" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
            Add Course
        </button>
        <button
        wire:click="export"
        class="bg-success text-white px-4 py-2 rounded hover:bg-green-700 transition"
    >
        Export Courses
    </button>
    </div>

    <!-- Modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-cloak
         class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-light rounded-md p-6 w-full max-w-2xl max-h-[80vh] overflow-y-auto">
            <h2 class="text-xl text-primary mb-4">{{ $courseId ? 'Edit Course' : 'Add Course' }}</h2>
            <form wire:submit="save">
                <div class="grid grid-cols-1 gap-4">
                    <div data-flux-field>
                        <label data-flux-label for="name">Name</label>
                        <input wire:model="name" id="name" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-4 flex gap-4 justify-end">
                    <button type="submit" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
                        {{ $courseId ? 'Update' : 'Save' }}
                    </button>
                    <button type="button" @click="open = false" wire:click="closeModal" class="bg-gray-500 text-light px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Courses Table -->
    <livewire:custom-table wire:key="courses-{{ $courses->count() }}-{{ $courses->pluck('id')->join('-') }}--{{ $refreshKey }}"
        :config="[
            'columns' => [
                ['label' => 'Name', 'key' => 'name'],
            ],
             'data' => $data, 
            'actions' => [
                [
                    'label' => 'Edit',
                    'event' => 'edit-course',
                    'class' => 'bg-info text-light px-3 py-1 rounded-md hover:bg-primary transition-colors',
                ],
                [
                    'label' => 'Delete',
                    'event' => 'delete-course',
                    'class' => 'bg-red-500 text-light px-3 py-1 rounded-md hover:bg-red-600 transition-colors',
                    'confirm' => true,
                    'confirmMessage' => 'Are you sure you want to delete this course? This will also delete associated batches.'
                ],
            ],
            'emptyMessage' => 'No courses found.'
        ]" />
        @if ($courses instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-4">
        {{ $courses->links('components.pagination-links') }}
    </div>
@endif

</div>
