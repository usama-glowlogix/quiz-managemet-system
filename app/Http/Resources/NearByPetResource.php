<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NearByPetResource extends JsonResource
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
            'user_id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_image'=>$this->last_name,
            'user_email'=>$this->email,
            'user_image'=>$this->image,
            'contact_no'=>$this->contact_number,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
        ];
    }
}
