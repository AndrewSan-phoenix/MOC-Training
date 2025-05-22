@props([])

<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-6">Batch Details Management</h1>

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
            Add Batch Details
        </button>
        <button
        wire:click="export"
        class="bg-success text-white px-4 py-2 rounded hover:bg-green-700 transition"
    >
        Export Batch Details
    </button>
    </div>

    <!-- Modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-cloak
         class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-light rounded-md p-6 w-full max-w-2xl max-h-[80vh] overflow-y-auto">
            <h2 class="text-xl text-primary mb-4">{{ $batchdetailsId ? 'Edit Batch Details' : 'Add Batch Details' }}</h2>
            <form wire:submit="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div data-flux-field>
                        <label data-flux-label for="batch_id">Batch</label>
                        <select wire:model="batch_id" id="batch_id" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            <option value="">Select Batch</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                        @error('batch_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div data-flux-field>
                        <label data-flux-label for="course_id">Teacher</label>
                        <select wire:model="teacher_id" id="teacher_id" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            <option value="">Select Teacher</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        @error('teacher_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div data-flux-field>
                        <label data-flux-label for="lecture_date">Lecture Date</label>
                        <input wire:model="lecture_date" id="lecture_date" type="date" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('lecture_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div data-flux-field>
                        <label data-flux-label for="timetable">Lecture Title <Title></Title></label>
                        <input wire:model="lecture_title" id="lecturetitle" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('lecturetitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-4 flex gap-4 justify-end">
                    <button type="submit" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
                        {{ $batchdetailsId ? 'Update' : 'Save' }}
                    </button>
                    <button type="button" @click="open = false" wire:click="closeModal" class="bg-gray-500 text-light px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Batches Table -->
    <livewire:custom-table wire:key="batchdetails-{{ $batchdetails->count() }}-{{ $batchdetails->pluck('id')->join('-') }}"
        :config="[
            'columns' => [
                ['label' => 'Batch', 'key' => 'batch.name'],
                ['label' => 'Teacher', 'key' => 'teacher.name'],
                ['label' => 'Lecture Date', 'key' => 'lecture_date'],
                ['label' => 'Lecture Title', 'key' => 'lecture_title'],
            ],
            'data' => $batchdetails->items(),
            'actions' => [
                [
                    'label' => 'Edit',
                    'event' => 'edit-batchdetails',
                    'class' => 'bg-info text-light px-3 py-1 rounded-md hover:bg-primary transition-colors',
                ],
                [
                    'label' => 'Delete',
                    'event' => 'delete-batchdetails',
                    'class' => 'bg-red-500 text-light px-3 py-1 rounded-md hover:bg-red-600 transition-colors',
                    'confirm' => true,
                    'confirmMessage' => 'Are you sure you want to delete this batch?'
                ],
            ],
            'emptyMessage' => 'No batches found.'
        ]" />@if ($batchdetails instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-4">
        {{ $batchdetails->links('components.pagination-links') }}
    </div>
@endif

</div>
