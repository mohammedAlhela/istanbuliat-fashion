<?php

namespace App\Imports;

use App\Models\Size;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class SizeImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct()
    {
        Size::truncate();
    }


    public function model(array $row)
    {
        return new Size([
            'name' => $row['size']
        ]);
    }
}
