<?php

namespace App\Http\Resources\Admins\Export;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminsExportResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role == 1 ? "manager" : "admin" ,
            'status' => $this->status == 1 ? "active" : "not active" ,
            'last_seen' => $this->last_seen,
        ];
    }
}
