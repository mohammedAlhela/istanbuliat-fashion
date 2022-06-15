<?php

namespace App\Http\Resources\Admins\Export;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesExportResource extends JsonResource
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
            'arabic_name' => $this->arabic_name,
            'status' => $this->status == 1 ? "active" : "blocked",
            'products number' => count($this->products) > 0 ? count($this->products) : '0'  ,
            'sub categories number' => count($this->subCategories) > 0 ? count($this->subCategories) : '0'  ,

        ];
    }
}
