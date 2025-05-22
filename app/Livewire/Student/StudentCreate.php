<?php
namespace App\Livewire\Student;
use App\Models\Student;
use Livewire\Component;

class StudentCreate extends Component
{
    public $name, $dob, $gender, $nrc, $phone, $email, $address;
    public function render()
    {
        return view('livewire.student.student-create');
    }
    public function submit(){
        $this->validate([
        'name' => 'required',
        'dob' => 'required|date',
        'gender' => 'required',
        'nrc' => 'required',
        'phone' => 'required|unique:students,phone',
        'email' => 'required|email',
        'address' => 'required'
        ]);
        Student::create([
            'name' => $this->name,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'nrc' => $this->nrc,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address
        ]);
        return to_route('student.index')->with('success', 'Student Created Successfully');
    }
   

    }

