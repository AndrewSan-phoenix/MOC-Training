<div>
    @props([])

    <div class="container mx-auto p-4">
        <h1 class="text-2xl mb-6">Student Management</h1>

        <div x-data="{ message: '' }" x-init="
            window.addEventListener('notify', event => {
                message = event.detail.message;
                setTimeout(() => message = '', 3000);
            });
        ">
            <div x-show="message" x-transition class="bg-info text-light p-4 rounded-md mb-4" x-text="message"></div>
        </div>

        <div class="mb-6">
            <button wire:click="openModal" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
                Add Student
            </button>
            <button
                wire:click="export"
                class="bg-success text-light px-4 py-2 rounded-md hover:bg-green-700 transition-colors"
            >
                Export Students
            </button>
        </div>

        <div x-data="{ open: @entangle('showModal') }" x-show="open" x-cloak
             class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-light rounded-md p-6 w-full max-w-2xl max-h-[80vh] overflow-y-auto">
                <h2 class="text-xl text-primary mb-4">{{ $studentId ? 'Edit Student' : 'Add Student' }}</h2>
                <form wire:submit="save">

                    <div>
                        <label for="profile_image" class="block font-medium">Profile Image</label>
                        <input wire:model="profile_image" id="profile_image" type="file" accept="image/*"
                            class="w-full border border-gray-300 rounded-md p-2">
                        @error('profile_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                        {{-- Display New Image Preview (if a new file is selected) --}}
                        @if ($profile_image)
                            <div class="mt-2">
                                <p class="text-gray-600 text-sm">New Image Preview:</p>
                                <img src="{{ $profile_image->temporaryUrl() }}" class="mt-1 w-32 h-32 object-cover rounded shadow" alt="New Image Preview">
                            </div>
                        {{-- Display Current Image (if in edit mode and no new file selected) --}}
                        @elseif ($existingProfileImage)
                            <div class="mt-2">
                                <p class="text-gray-600 text-sm">Current Image:</p>
                                <img src="{{ Storage::url($existingProfileImage) }}" class="mt-1 w-32 h-32 object-cover rounded shadow" alt="Current Image">
                            </div>
                        @endif
                    </div>
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div data-flux-field>
                            <label data-flux-label for="name">Name</label>
                            <input wire:model="name" id="name" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div data-flux-field>
                            <label data-flux-label for="dob">Date of Birth</label>
                            <input wire:model="dob" id="dob" type="date" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            @error('dob') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div data-flux-field>
                            <label data-flux-label for="gender">Gender</label>
                            <select wire:model="gender" id="gender" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                                <option value="">Select Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Other</option>
                            </select>
                            @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div data-flux-field>
                            <label data-flux-label for="nrc">NRC</label>
                            <input wire:model="nrc" id="nrc" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            @error('nrc') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div data-flux-field>
                            <label data-flux-label for="phone">Phone</label>
                            <input wire:model="phone" id="phone" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div data-flux-field>
                            <label data-flux-label for="email">Email</label>
                            <input wire:model="email" id="email" type="email" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div data-flux-field class="md:col-span-2">
                            <label data-flux-label for="address">Address</label>
                            <textarea wire:model="address" id="address" data-flux-control class="w-full border-gray-300 rounded-md p-2"></textarea>
                            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex gap-4 justify-end">
                        <button type="submit" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
                            {{ $studentId ? 'Update' : 'Save' }}
                        </button>
                        <button type="button" @click="open = false" wire:click="closeModal" class="bg-gray-500 text-light px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <livewire:custom-table wire:key="students-{{ $students->currentPage() }}-{{ $students->total() }}-{{ $refreshKey }}"
            :config="[
                'columns' => [
                    ['label' => 'Profile Image', 'key' => 'profile_image'], // Add profile image column here
                    ['label' => 'Name', 'key' => 'name'],
                    ['label' => 'Date of Birth', 'key' => 'dob'],
                    ['label' => 'Gender', 'key' => 'gender_label'],
                    ['label' => 'NRC', 'key' => 'nrc'],
                    ['label' => 'Phone', 'key' => 'phone'],
                    ['label' => 'Email', 'key' => 'email'],
                    ['label' => 'Address', 'key' => 'address'],
                ],
                'data' => $data,
                'actions' => [
                    [
                        'label' => 'Edit',
                        'event' => 'edit-student',
                        'class' => 'bg-info text-light px-3 py-1 rounded-md hover:bg-primary transition-colors',
                    ],
                    [
                        'label' => 'Delete',
                        'event' => 'delete-student',
                        'class' => 'bg-red-500 text-light px-3 py-1 rounded-md hover:bg-red-600 transition-colors',
                        'confirm' => true,
                        'confirmMessage' => 'Are you sure you want to delete this student? This will also delete associated enrollments.'
                    ],
                ],
                'emptyMessage' => 'No students found.'
            ]"
        />

        @if ($students instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-4">
                {{ $students->links('components.pagination-links') }}
            </div>
        @endif
    </div>
</div>