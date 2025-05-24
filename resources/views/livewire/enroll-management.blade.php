@props([])

<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-6">Enrollment Management</h1>

    <!-- Notification -->
    <div x-data="{ message: '' }" x-init="
        window.addEventListener('notify', event => {
            message = event.detail.message;
            setTimeout(() => message = '', 3000);
        });
    ">
        <div x-show="message" x-transition class="bg-info text-light p-4 rounded-md mb-4" x-text="message"></div>
    </div>

    <!-- Add Enrollment Button -->
    <div class="mb-6">
        <button wire:click="openModal" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
            Add Enrollment
        </button>
        <button
            wire:click="export"
            class="bg-success text-white px-4 py-2 rounded hover:bg-green-700 transition"
        >
            Export Enrolls
        </button>
    </div>

    <!-- Modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-cloak
         class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-light rounded-md p-6 w-full max-w-2xl max-h-[80vh] overflow-y-auto">
            <h2 class="text-xl text-primary mb-4">{{ $enrollId ? 'Edit Enrollment' : 'Add Enrollment' }}</h2>
            <form wire:submit="save">
                <div class="grid grid-cols-1 gap-4">
                    <div data-flux-field>
                        <label data-flux-label for="batch_id">Batch</label>
                        <select wire:model="batch_id" id="batch_id" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            <option value="">Select Batch</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">
                                    {{ $batch->course->name ?? 'No Course' }} - {{ $batch->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('batch_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="student_id">Student</label>
                        <select wire:model="student_id" id="student_id" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            <option value="">Select Student</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                        @error('student_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="enroll_date">Enrollment Date</label>
                        <input wire:model="enroll_date" id="enroll_date" type="date" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('enroll_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-4 flex gap-4 justify-end">
                    <button type="submit" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
                        {{ $enrollId ? 'Update' : 'Save' }}
                   
                    </button>
                    <button type="button" @click="open = false" wire:click="closeModal" class="bg-gray-500 text-light px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Enrollments Table -->
    <livewire:custom-table wire:key="enrollments-{{ $enrollments->count() }}-{{ $enrollments->pluck('id')->join('-') }}"
        :config="[
            'columns' => [
                ['label' => 'Batch', 'key' => 'batch_course'],
                ['label' => 'Student', 'key' => 'student.name'],
                ['label' => 'Enrollment Date', 'key' => 'enroll_date'],
            ],
            'data' => $enrollments->items(),
            'actions' => [
                [
                    'label' => 'Edit',
                    'event' => 'edit-enroll',
                    'class' => 'bg-info text-light px-3 py-1 rounded-md hover:bg-primary transition-colors',
                ],
                [
                    'label' => 'Delete',
                    'event' => 'delete-enroll',
                    'class' => 'bg-red-500 text-light px-3 py-1 rounded-md hover:bg-red-600 transition-colors',
                    'confirm' => true,
                    'confirmMessage' => 'Are you sure you want to delete this enrollment?'
                ],
            ],
            'emptyMessage' => 'No enrollments found.'
        ]" />
    @if ($enrollments instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4">
            {{ $enrollments->links('components.pagination-links') }}
        </div>
    @endif

</div>