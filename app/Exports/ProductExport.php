<?php

namespace App\Exports;
use App\Models\Product;
use App\Http\Resources\ProductsExportResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;


class ProductExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{


    public function collection()
    {
        return collect(ProductsExportResource::collection(Product::with('colors' , 'sizes')->get()));
    }

    public function headings(): array
    {
        return [
            'addmission',
            'name',
            'category',
            'sku',
            'selling price',
            'discount price',
            'status',
            'quantity',
            'orders number',
            'colors',
            'sizes',
            'wash care',
            'contents',
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
