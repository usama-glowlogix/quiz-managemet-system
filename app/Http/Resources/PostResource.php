<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Auth;
use App\Models\User;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        $total_likes=Like::with('posts')->where('post_id',$this->id)->count();
        $total_comments=Comment::with('posts')->where('post_id',$this->id)->count();

        $is_post_like = Like::where([['post_id',$this->id],['user_id',Auth::id()]])->first();
        $is_post_like ? $is_like = true : $is_like = false;
        return[
            'id'=>$this->id,
            'user_id'=>$this->user->id,
            'post_image'=>$this->image,
            'color'=>$this->color,
            'description'=>$this->description,
            'likes'=>$total_likes,
            'total_comments'=>$total_comments,
            'is_like'=>$is_like,
            'user_email'=>$this->user->email,
            'first_name'=>$this->user->first_name,
            'last_name'=>$this->user->last_name,
            'contact_number'=>$this->user->contact_number,
            'user_image'=>$this->user->image,
            
        ];
    }
}
