<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;

class StudentCreate extends Component
{
    public $Studentname, $DOB, $Gender, $NRC, $Phone, $Email, $Address;
    public function render()
    {
        return view('livewire.student.student-create');
    }
    public function submit(){
        $this->validate([
        "Studentname"=>"required",
        "DOB"=>"required",
        "Gender"=>"required",
        "NRC"=>"required",
        "Phone"=>"required|unique:student,Phone",
        "Email"=>"required|email",
        "Address"=>"required"
        ]);
        Student::create([
            "Studentname"=>$this->Studentname,
            "DOB"=>$this->DOB,
            "Gender"=>$this->Geneder,
            "NRC"=>$this->NRC,
            "Phone"=>$this->Phone,
            "Email"=>$this->Email,
            "Address"=>$this->Address
        ]);
        return to_route('student.index')->with('message', 'Student Created Successfully');
    }
   

    }

