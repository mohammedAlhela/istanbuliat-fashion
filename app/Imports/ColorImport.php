<?php

namespace App\Imports;

use App\Models\Color;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ColorImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function __construct()
    {
        Color::truncate();
    }

    public function model(array $row)
    {
        return new Color([
            // 'id' => (int)$row[0],
            'name' => $row[1],
            'hex' =>$row[2] ,
        ]);
    }
}
