<?php

namespace App\Http\Resources\Admins;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminsResource extends JsonResource
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

            'email' => $this->email,

            'password' => '',

            'role' => $this->role == 1 ? "admin" : "manager",

            'last_seen' => $this->last_seen,

            'status' => $this->status == 1 ? "active" : "blocked",
        ];

    }
}
