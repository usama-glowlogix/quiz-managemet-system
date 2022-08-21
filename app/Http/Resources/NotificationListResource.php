<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Setting;
class NotificationListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     
        return[
         'id'=>$this->id,
         'title'=>$this->title,
         'message'=>$this->message,
         'type'=>$this->type,
         'redirect'=>$this->redirect,
         'user_id'=>$this->user->id, 
         'user_name'=>$this->user->first_name,
         'user_email'=>$this->user->email,
         'user_image'=>$this->user->image,
         'status'=>$this->status,
         'time'=>$this->created_at->format('H:i')

        ];

    }
}
