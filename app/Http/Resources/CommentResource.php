<?php

namespace App\Http\Resources;

use App\Rating;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $id = $this->additional['id'];
        $comments = Rating::whereNotNull('comment')->whereIn('reservation_id',$id)->select('created_at','comment','star','user_id')->with('user')->get()->toArray();
        $array = [];

        foreach ($comments as $comment){
            $temp = ['username' => $comment['user']['name'],
                'photo' => $comment['user']['image'],
                'time' => $comment['created_at'],
                'star' => $comment['star'],
                'comment' => $comment['comment']];
            array_push($array,$temp);

        }
        return $array;
    }
}
