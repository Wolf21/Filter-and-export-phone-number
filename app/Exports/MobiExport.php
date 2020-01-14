<?php

namespace App\Exports;

use App\Mobis;
use Maatwebsite\Excel\Concerns\FromCollection;

class MobiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mobis::all();
    }
}
