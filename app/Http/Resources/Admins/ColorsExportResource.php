<?php

namespace App\Http\Resources\Admins;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Color;

class ColorsExportResource extends JsonResource
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

            'hex' => $this->hex,

            'note' => count($this->variations) ? "this record has related data please dont delete it" : "",

            // 'created_at' => $this->created_at,

            // 'updated_at' => $this->updated_at,

        ];

    }
}
