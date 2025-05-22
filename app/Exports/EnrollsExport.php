<?php

namespace App\Exports;

use App\Models\Enroll;
use Maatwebsite\Excel\Concerns\FromCollection;

class EnrollsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Enroll::all();
    }
}
