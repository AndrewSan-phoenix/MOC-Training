<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;

class StudentEdit extends Component
{
    public $student, $name, $dob, $gender, $nrc, $phone, $email, $address;
    public function mount($id)
    {
        $this->student= Student::find($id);
        $this->name = $this->student->name;
        $this->dob = $this->student->dob;
        $this->gender = $this->student->gender;
        $this->nrc = $this->student->nrc;
        $this->phone = $this->student->phone;
        $this->email = $this->student->email;
        $this->address = $this->student->address;
    }
    public function render()
    {
        return view('livewire.student.student-edit');
    }
    public function submit(){
        $this->validate([
        'name' => 'required',
        'dob' => 'required|date',
        'gender' => 'required',
        'nrc' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'address' => 'required'
        ]);
       
        $this->student->name=$this->name;
        $this->student->dob=$this->dob;
        $this->student->gender=$this->gender;
        $this->student->nrc=$this->nrc;
        $this->student->phone=$this->phone;
        $this->student->email=$this->email;
        $this->student->address=$this->address;
        $this->student->save();
        return to_route('student.index')->with('success', 'Student Updated Successfully');
    }

}
