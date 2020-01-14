<?php

namespace App\Imports;

use App\Phones;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class PhonesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new Phones([
            'phone' => $row[0]
        ]);
    }
}
