<?php

namespace App\Exports;

use App\Vietels;
use Maatwebsite\Excel\Concerns\FromCollection;

class VietelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vietels::all();
    }
}
