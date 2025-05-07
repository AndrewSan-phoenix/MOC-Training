<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class StudentManagement extends Component
{
    public $students;
    public $studentId = null;
    public $showModal = false;

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

    public function mount()
    {
        $this->loadStudents();
    }

    public function loadStudents()
    {
        $this->students = Student::all();
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
            'dob' => $this->dob,
            'gender' => $this->gender,
            'nrc' => $this->nrc,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ];

        if ($this->studentId) {
            // Update existing student
            $student = Student::findOrFail($this->studentId);
            $student->update($data);
        } else {
            // Create new student
            Student::create($data);
        }

        $this->closeModal();
        $this->loadStudents();
        $this->dispatch('notify', message: $this->studentId ? 'Student updated successfully!' : 'Student created successfully!');
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
        $this->showModal = true;
    }

    #[On('delete-student')]
    public function delete($id)
    {
        Student::findOrFail($id)->delete();
        $this->loadStudents();
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
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.student-management');
    }
}
