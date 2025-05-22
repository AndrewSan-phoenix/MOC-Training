<?php


namespace App\Livewire;

use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Teacher;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class TeacherManagement extends Component
{
    use WithPagination, WithFileUploads;

    public $teacherId = null;
    public $showModal = false;
    public $refreshKey = 0; // Used to force UI refresh
    public $existingProfileImage = null; // To store the existing image path

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|string|max:255')]
    public $position = '';

    #[Validate('required|string|max:255')]
    public $organization = '';

    #[Validate('required|date')]
    public $dob = '';

    #[Validate('required|in:1,2,3')]
    public $gender = '';

    #[Validate('required|string|max:50')]
    public $nrc = '';

    #[Validate('required|string|max:20')]
    public $phone = '';

    #[Validate('required|email|max:255')]
    public $email = '';

    #[Validate('required|string|max:500')]
    public $address = '';

    #[Validate('nullable|image|max:1025')]
    public $profile_image = null; // For file upload

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

        $data = [
            'name' => $this->name,
            'position' => $this->position,
            'organization' => $this->organization,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'nrc' => $this->nrc,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ];

        if ($this->profile_image) {
            // Delete the old image if it exists
            if ($this->existingProfileImage) {
                Storage::delete($this->existingProfileImage);
            }

            // Store the new image
            $data['profile_image'] = $this->profile_image->store('profile_images', 'public');
        }

        $msg = $this->teacherId ? 'Teacher updated successfully!' : 'Teacher created successfully!';
        if ($this->teacherId) {
            // Update existing teacher
            $teacher = Teacher::findOrFail($this->teacherId);
            $teacher->update($data);
        } else {
            // Create new teacher
            Teacher::create($data);
        }

        $this->closeModal();
        $this->resetPage(); // Reset to first page after save
        // $this->refreshKey = rand(1000, 9999); // Force UI refresh

        $this->dispatch('notify', message: $msg);
    }

    #[On('edit-teacher')]
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $this->teacherId = $teacher->id;
        $this->name = $teacher->name;
        $this->position = $teacher->position;
        $this->organization = $teacher->organization;
        $this->dob = $teacher->dob;
        $this->gender = $teacher->gender;
        $this->nrc = $teacher->nrc;
        $this->phone = $teacher->phone;
        $this->email = $teacher->email;
        $this->address = $teacher->address;
        $this->existingProfileImage = $teacher->profile_image;
        $this->showModal = true;
    }

    #[On('delete-teacher')]
    public function delete($id)
    {
        $teacher = Teacher::findOrFail($id);

        // Delete the profile image if it exists
        if ($teacher->profile_image) {
            Storage::delete($teacher->profile_image);
        }

        $teacher->delete();
        $this->resetPage();
        $this->refreshKey = rand(1000, 9999); // Force UI refresh
        $this->dispatch('notify', message: 'Teacher deleted successfully!');
    }

    public function resetForm()
    {
        $this->teacherId = null;
        $this->name = '';
        $this->position = '';
        $this->organization = '';
        $this->dob = '';
        $this->gender = '';
        $this->nrc = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->profile_image = null;
        $this->existingProfileImage = null;
        $this->resetValidation();
    }

    public function export(): StreamedResponse
    {
        $filename = 'teachers_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            // CSV headers
            fputcsv($handle, ['ID', 'Name', 'Position', 'Organization', 'DOB', 'Gender', 'NRC', 'Phone', 'Email', 'Address']);

            // Data rows
            Teacher::cursor()->each(function ($teacher) use ($handle) {
                fputcsv($handle, [
                    $teacher->id,
                    $teacher->name,
                    $teacher->position,
                    $teacher->organization,
                    $teacher->dob,
                    $teacher->gender,
                    $teacher->nrc,
                    $teacher->phone,
                    $teacher->email,
                    $teacher->address,
                ]);
            });

            fclose($handle);
        }, $filename);
    }

    public function render()
    {
        $teachers = Teacher::paginate(5);
        $data = $teachers->items();
        return view('livewire.teacher-management', compact('teachers', 'data'));
    }
}