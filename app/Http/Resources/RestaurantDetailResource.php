<?php

namespace App\Http\Resources;

use App\Helper\Helper;
use App\Image;
use App\Offer;
use App\Restaurant;
use App\Save;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantDetailResource extends JsonResource
{
    public $helper;
    public $restaurantData;
    public function toArray($request)
    {
        $this->restaurantData = $restaurantData = Restaurant::find($this->id);
        return [
            'head' => [
                'saved_status' => Save::where('id',$this->id)->exists() ? Save::where('id',$this->id)->first('id')->id : '0',
                'image' => $restaurantData->first('image')->image,
                'name' => $restaurantData->first('name')->name,
                'description' => $restaurantData->first('description')->description,
            ],
            'room-mainHall' => [
                'room' => $restaurantData->first('room')->room,
                'mainhall' => $restaurantData->first('mainhall')->mainhphpall,
            ],
            'menu' => [
                'open_menu' => $restaurantData->first()->menu->menu,
                'open_pdf' => $restaurantData->first()->menu->pdf
            ],
            'photos' => $this->helper->insertDataIntoArray(['photo'],Image::where('imageable_id',$this->id)->select('url')->get()->toArray()),
            'about' => [
                'phone' => $restaurantData->first('phone')->phone,
                'average_price' => $restaurantData->first('average_price')->average_price,
                'hours' => $restaurantData->first('open_time')->open_time .'-'. $restaurantData->first('close_time')->close_time,
                'metro' => $restaurantData->first('metro')->metro,
                'payment_method' => $restaurantData->first('payment_method')->payment_method,
                'dress_code' => $restaurantData->first('dress_code')->dress_code,
                'parking' => $restaurantData->first('parking')->parking,
                'description' => $restaurantData->first('description')->description,
            ],
            'offers' => (new RestaurantOfferResource($this->restaurantData))->additional(['id'=>$this]),
            'rating' => (new RestaurantRatingResource($this->restaurantData))->additional(['id'=>$this])

        ];
    }
}
