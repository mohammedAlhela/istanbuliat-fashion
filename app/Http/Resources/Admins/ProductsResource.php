<?php

namespace App\Http\Resources\Admins;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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

            'name' => $this->name,

            'image' => $this->image,

            'selling_price' => $this->selling_price,

            'discount_price' => $this->discount_price,

            'price' => $this->price,

            'category_id' => $this->category_id,

            'slug' => $this->slug,

            'sku' => $this->sku,

            'long_description' => $this->long_description,

            'status' => $this->status,

            'wash_care' => $this->wash_care,


            // relations
            
            'category' => $this->category,

            'variations' => $this->variations,

            'tags' => $this->tags,

            'sizeGuides' => $this->sizeGuides,

            'colors' => $this->colors,

            'sizes' => $this->sizes,

            // relations

        ];

    }
}
