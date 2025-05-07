<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;

class StudentIndex extends Component
{

    
    public function render()
    {
        $students= Student::all();
        return view('livewire.student.student-index',compact('students'));
    }
    public function delete($id){
        $student= Student::find($id);
        $student->delete();
        return to_route('student.index')->with('success', 'Student Deleted Successfully');
    }
}
