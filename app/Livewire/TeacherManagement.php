<?php

namespace App\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class TeacherManagement extends Component
{
    public $teachers;
    public $teacherId = null;
    public $showModal = false;

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

    public function mount()
    {
        $this->loadTeachers();
    }

    public function loadTeachers()
    {
        $this->teachers = Teacher::all();
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

        if ($this->teacherId) {
            // Update existing teacher
            $teacher = Teacher::findOrFail($this->teacherId);
            $teacher->update($data);
        } else {
            // Create new teacher
            Teacher::create($data);
        }

        $this->closeModal();
        $this->loadTeachers();
        $this->dispatch('notify', message: $this->teacherId ? 'Teacher updated successfully!' : 'Teacher created successfully!');
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
        $this->showModal = true;
    }

    #[On('delete-teacher')]
    public function delete($id)
    {
        Teacher::findOrFail($id)->delete();
        $this->loadTeachers();
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
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.teacher-management');
    }
}
