<?php

namespace App\Http\Resources;

use App\Models\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsExportResource extends JsonResource
{

    public function __construct($resource)
    {
        // Ensure we call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource; // $apple param passed
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'category_id' => Category::find($this->category_id)->name,
            'sku' => $this->sku,
            'selling_price' => $this->selling_price,
            'discount_price' => $this->discount_price,
            'status' => $this->status ? "active" : "draft",
            'stock_qty' => $this->stock_qty ? $this->stock_qty : 0,
            'stock_ordered' => $this->stock_ordered ? $this->stock_ordered : 0,
            'colors' => count($this->colors)  ?  implode("," , $this->colors->pluck('name')->all() )  : 'no colors added',
            'sizes' => count($this->sizes)  ?  implode("," , $this->sizes->pluck('name')->all() )  : 'no sizes added',
            'wash_care' => $this->wash_care  ,
            'contents' => $this->contents ,

        ];
    }
}
