<?php

namespace App\Imports;

use App\Models\PersonalData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonalDataImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PersonalData([
            //

            'firstname'     => $row['firstname'],
            'lastname'    => $row['lastname'],
            'email'        => $row['email'],
            'telephone'    => $row['telephone']
        ]);
    }
}
