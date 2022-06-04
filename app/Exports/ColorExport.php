<?php

namespace App\Exports;
use App\Models\Color;
// use App\Http\Resources\Admins\ColorsExportResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ColorExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    public function collection()
    {
        return Color::all();
        // return collect(AdminsExportResource::collection(User::orderBy('created_at', 'DESC')->where('role' ,  '!=' , 0)->get()));
    }

    public function headings(): array
    {
        return [
            // 'id',
            // 'name',
            // 'hex-value',
            // 'note',

            'Addmission',
            'name',
            'hex',

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
