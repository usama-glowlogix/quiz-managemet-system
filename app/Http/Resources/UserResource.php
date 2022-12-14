<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_image'=>$this->last_name,
            'email'=>$this->email,
            'image'=>$this->image,
            'contact_no'=>$this->contact_number,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
        ];
    }
}
