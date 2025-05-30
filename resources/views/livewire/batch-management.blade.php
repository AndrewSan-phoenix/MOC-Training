@props([])

<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-6">Batch Management</h1>

    <!-- Notification -->
    <div x-data="{ message: '' }" x-init="
        window.addEventListener('notify', event => {
            message = event.detail.message;
            setTimeout(() => message = '', 3000);
        });
    ">
        <div x-show="message" x-transition class="bg-info text-light p-4 rounded-md mb-4" x-text="message"></div>
    </div>

    <!-- Add Batch Button -->
    <div class="mb-6">
        <button wire:click="openModal" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
            Add Batch
        </button>
        
    <button
        wire:click="export"
        class="bg-success text-white px-4 py-2 rounded hover:bg-green-700 transition"
    >
        Export Batches
    </button>


    </div>

    <!-- Modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-cloak
         class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-light rounded-md p-6 w-full max-w-2xl max-h-[80vh] overflow-y-auto">
            <h2 class="text-xl text-primary mb-4">{{ $batchId ? 'Edit Batch' : 'Add Batch' }}</h2>
            <form wire:submit="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div data-flux-field>
                        <label data-flux-label for="name">Name</label>
                        <input wire:model="name" id="name" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="course_id">Course</label>
                        <select wire:model="course_id" id="course_id" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            <option value="">Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        @error('course_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="timetable">Timetable</label>
                        <input wire:model="timetable" id="timetable" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('timetable') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="start_date">Start Date</label>
                        <input wire:model="start_date" id="start_date" type="date" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="end_date">End Date</label>
                        <input wire:model="end_date" id="end_date" type="date" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="fees">Fees</label>
                        <input wire:model="fees" id="fees" type="number" step="0.01" min="0" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('fees') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-4 flex gap-4 justify-end">
                    <button type="submit" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
                        {{ $batchId ? 'Update' : 'Save' }}
                    </button>
                    <button type="button" @click="open = false" wire:click="closeModal" class="bg-gray-500 text-light px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <livewire:custom-table wire:key="batches-{{ $batches->count() }}-{{ $batches->pluck('id')->join('-') }}--{{ $refreshKey }}"
    :config="[
        'columns' => [
            ['label' => 'Name', 'key' => 'name'],
            ['label' => 'Course', 'key' => 'course.name'],
            ['label' => 'Timetable', 'key' => 'timetable'],
            ['label' => 'Start Date', 'key' => 'start_date'],
            ['label' => 'End Date', 'key' => 'end_date'],
            ['label' => 'Fees', 'key' => 'fees'],
        ],
        'data' => $batches->items(), 
        'actions' => [
            [
                'label' => 'Edit',
                'event' => 'edit-batch',
                'class' => 'bg-info text-light px-3 py-1 rounded-md hover:bg-primary transition-colors',
            ],
            [
                'label' => 'Delete',
                'event' => 'delete-batch',
                'class' => 'bg-red-500 text-light px-3 py-1 rounded-md hover:bg-red-600 transition-colors',
                'confirm' => true,
                'confirmMessage' => 'Are you sure you want to delete this batch?'
            ],
        ],
        'emptyMessage' => 'No batches found.'
    ]" />
    @if ($batches instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-4">
        {{ $batches->links('components.pagination-links') }}
    </div>
@endif

</div>