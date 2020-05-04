<?php

namespace App\Http\Resources;

use App\Rating;
use App\Reservation;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantRatingResource extends JsonResource
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
        $restaurant  = Reservation::where('restaurant_id',$id->id)->select('id')->get()->toArray();
        $ratingData  = Rating::whereIn('reservation_id',$restaurant)->get();
        return [
            'design' => $ratingData->avg('design'),
            'service' => $ratingData->avg('service'),
            'food' => $ratingData->avg('food'),
            'contingent' => $ratingData->avg('contingent'),
            'total_rating' => $ratingData->count(),
            'five_star' => $ratingData->where('star',5)->count(),
            'four_star' => $ratingData->where('star',4)->count(),
            'three_star' => $ratingData->where('star',3)->count(),
            'two_star' => $ratingData->where('star',2)->count(),
            'one_star' => $ratingData->where('star',1)->count(),
        ];
    }
}
