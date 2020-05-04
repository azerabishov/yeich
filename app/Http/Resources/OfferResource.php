<?php

namespace App\Http\Resources;

use App\Helper\Helper;
use App\Offer;
use App\Restaurant;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public $helper;
    public $restaurantData;
    public $offerData;

    public function toArray($request)
    {
        $array = [];
        $array['offers'] = [];
        $offerData = Offer::with('restaurant')->get();
        foreach ($offerData as $data){
            $addedData = [
                'id' => $data->id,
                'image' => $data->image,
                'description' => $data->description,
                'sub_description' => $data->sub_description,
                'offer_hours' => $data->offer_hours,
                'restaurant_id' => $data->restaurant_id,
                'restaurant_name' => $data->restaurant->name,
            ];
            array_push($array['offers'],$addedData);
        }


        return $array;
    }


//'id' => $row['id'],
//"offerimage" => $row['offerimage'],
//"offerDescription" => $row['offerDescription_az'],
//"offerSubDescription" => $row['offerSubDescription_az'],
//"offerRest" => $offers->getOfferRestName($row['restaurantid']),
//"offerHours" => $row['offerHours'],
//"restaurantid" =>$row['restaurantid'],

}
