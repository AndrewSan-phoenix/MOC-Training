@props([])

<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-6">Teacher Management</h1>

    <!-- Notification -->
    <div x-data="{ message: '' }" x-init="
        window.addEventListener('notify', event => {
            message = event.detail.message;
            setTimeout(() => message = '', 3000);
        });
    ">
        <div x-show="message" x-transition class="bg-info text-light p-4 rounded-md mb-4" x-text="message"></div>
    </div>

    <!-- Add Teacher Button -->
    <div class="mb-6">
        <button wire:click="openModal" class="bg-info text-light px-4 py-2 rounded-md hover:bg-primary transition-colors">
            Add Teacher
        </button>
        <button
        wire:click="export"
        class="bg-success text-light px-4 py-2 rounded-md hover:bg-green-700 transition-colors"
    >
        Export Teachers
    </button>
    </div>

    <!-- Export Button
<div class="mb-4 flex justify-end">
    
</div> -->

    <!-- Modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-cloak
         class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-light rounded-md p-6 w-full max-w-2xl max-h-[80vh] overflow-y-auto">
            <h2 class="text-xl text-primary mb-4">{{ $teacherId ? 'Edit Teacher' : 'Add Teacher' }}</h2>
            <form wire:submit="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="profile_image">Profile Image</label>
                        <input wire:model="profile_image" id="profile_image" type="file" accept="image/*" class="w-full border-gray-300 rounded-md p-2">
                        @if ($existingProfileImage)
                            <div class="mt-2">
                                <img src="{{ Storage::url($existingProfileImage) }}" alt="Profile Image" class="w-20 h-20 rounded-full">
                            </div>
                        @endif
                        @error('profile_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="name">Name</label>
                        <input wire:model="name" id="name" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="position">Position</label>
                        <input wire:model="position" id="position" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('position') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div data-flux-field>
                        <label data-flux-label for="organization">Organization</label>
                        <input wire:model="organization" id="organization" type="text" data-flux-control class="w-full border-gray-300 rounded-md p-2">
                        @error('organization') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                        {{ $teacherId ? 'Update' : 'Save' }}
                    </button>
                    <button type="button" @click="open = false" wire:click="closeModal" class="bg-gray-500 text-light px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Teachers Table -->
    <livewire:custom-table wire:key="teachers-{{ $teachers->count() }}-{{ $teachers->pluck('id')->join('-') }}"
        :config="[
            'columns' => [
                ['label' => 'ID', 'key' => 'id'],
                ['label' => 'Profile Image', 'key' => 'profile_image'],
                ['label' => 'Name', 'key' => 'name'],
                ['label' => 'DOB', 'key' => 'dob'],
                ['label' => 'Gender', 'key' => 'gender_label'],
                ['label' => 'NRC', 'key' => 'nrc'],
                ['label' => 'Position', 'key' => 'position'],
                ['label' => 'Organization', 'key' => 'organization'],
                ['label' => 'Email', 'key' => 'email'],
                ['label' => 'Phone', 'key' => 'phone'],
            ],
            'data' => $data,
            'actions' => [
                [
                    'label' => 'Edit',
                    'event' => 'edit-teacher',
                    'class' => 'bg-info text-light px-3 py-1 rounded-md hover:bg-primary transition-colors',
                ],
                [
                    'label' => 'Delete',
                    'event' => 'delete-teacher',
                    'class' => 'bg-red-500 text-light px-3 py-1 rounded-md hover:bg-red-600 transition-colors',
                    'confirm' => true,
                    'confirmMessage' => 'Are you sure you want to delete this teacher?'
                ],
            ],
            'emptyMessage' => 'No teachers found.'
        ]" />
         <!-- Pagination Links -->
    @if ($teachers instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4">
            {{ $teachers->links('components.pagination-links') }}
        </div>
        
    @endif
</div>
