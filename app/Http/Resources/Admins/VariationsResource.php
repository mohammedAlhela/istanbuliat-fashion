<?php

namespace App\Http\Resources\Admins;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Variation;

use App\Models\Size;

use App\Models\Color;

class VariationsResource extends JsonResource
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

            'id' => $this->id,

            'product_id' => $this->product_id,

            'product' => $this->product,

            'color_id' => $this->color_id,

            'color' => $this->color,

            'size_id' => $this->size_id,


            'size' => $this->size,

            'stock_qty' => $this->stock_qty,

            'stock_ordered' => $this->stock_ordered,

            'status' => $this->status,

            'sku' => $this->sku,

            'discount_price' => $this->discount_price,

            'selling_price' => $this->selling_price,

            'image' => $this->image,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];

    }
}
