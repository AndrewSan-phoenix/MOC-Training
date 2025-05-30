<?php

namespace App\Livewire;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class StudentManagement extends Component
{
     use WithPagination, WithFileUploads;

    public $studentId = null;
    public $showModal = false;
    public $refreshKey = 0; // Used to force UI refresh
    // Removed duplicate declaration
    public $existingProfileImage = null; // To store the existing image path
    #[Validate('required|string|max:255')]
    public $name = '';

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

        $msg = $this->studentId ? 'Student updated successfully!' : 'Student created successfully!';
        if ($this->studentId) {
            // Update existing student

            $student = Student::findOrFail($this->studentId);
            $student->update($data);
        } else {
            // Create new student
            Student::create($data);
        }

        $this->closeModal();
        $this->resetPage(); // Reset to first page after save
        $this->refreshKey = rand(1000, 9999); // Force UI refresh

        $this->dispatch('notify', message: $msg);
    }

    #[On('edit-student')]
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->studentId = $student->id;
        $this->name = $student->name;
        $this->dob = $student->dob;
        $this->gender = $student->gender;
        $this->nrc = $student->nrc;
        $this->phone = $student->phone;
        $this->email = $student->email;
        $this->address = $student->address;
        $this->existingProfileImage = $student->profile_image;
        $this->showModal = true;
    }

    #[On('delete-student')]
    public function delete($id)
    {
        $student = Student::findOrFail($id);

        // Delete the profile image if it exists
        if ($student->profile_image) {
            Storage::delete($student->profile_image);
        }

        $student->delete();
        $this->resetPage();
        $this->refreshKey = rand(1000, 9999);
        $this->dispatch('notify', message: 'Student deleted successfully!');
    }

    public function resetForm()
    {
        $this->studentId = null;
        $this->name = '';
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
    // 👇 customise the file name if you like
    $filename = 'students_' . now()->format('Y-m-d_H-i-s') . '.csv';

    return response()->streamDownload(function () {
        $handle = fopen('php://output', 'w');

        // ---- CSV header row --------------------------------------------------
        fputcsv($handle, [
            'ID',
            'Name',
            'Date of Birth',
            'Gender',
            'NRC',
            'Phone',
            'Email',
            'Address',
        ]);

        // ---- Data rows -------------------------------------------------------
        Student::cursor()->each(function (Student $student) use ($handle) {
            fputcsv($handle, [
                $student->id,
                $student->name,
                $student->dob,
                // If you have getGenderLabelAttribute, you can use $student->gender_label
                $student->gender,
                $student->nrc,
                $student->phone,
                $student->email,
                $student->address,
            ]);
        });

        fclose($handle);
    }, $filename);
}

    public function render()
    {
        $students = Student::paginate(6);
        $data = $students->items();
        return view('livewire.student-management', compact('students', 'data'));
    }
}



