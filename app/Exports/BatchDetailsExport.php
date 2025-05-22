<?php

namespace App\Exports;

use App\Models\BatchDetail;
use Maatwebsite\Excel\Concerns\FromCollection;

class BatchDetailsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BatchDetail::all();
    }
}
