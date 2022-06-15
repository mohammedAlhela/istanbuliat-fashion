<?php

namespace App\Exports\Admins;
use App\Models\Color;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ColorExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    public function collection()
    {


        return Color::select('id' , 'name')->get();

    }

    public function headings(): array
    {
        return [
            'Addmission',
            'name',
      
        ];
    }

    // ...

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont('arial')->setSize(16);
            },

        ];
    }
}
