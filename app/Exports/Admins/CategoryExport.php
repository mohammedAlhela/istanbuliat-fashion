<?php

namespace App\Exports\Admins;

use App\Http\Resources\Admins\Export\CategoriesExportResource;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class CategoryExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    public function collection()
    {
        return collect(CategoriesExportResource::collection(Category::with(['products' , 'subCategories'])->get()));
    }

    public function headings(): array
    {
        return [
            'addmission',
            'name',
            'arabic name',
            'Status',
            'Products number',
            'Sub Categories number',

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
