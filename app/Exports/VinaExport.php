<?php

namespace App\Exports;

use App\Vinas;
use Maatwebsite\Excel\Concerns\FromCollection;

class VinaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vinas::all();
    }
}
