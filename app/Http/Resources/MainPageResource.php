<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MainPageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'root' => [
                [
                'name' => 'discover',
                'restaurants' => []
                ],
                [
                'name' => 'discover',
                'restaurants' => []
                ],
                [
                'name' => 'discover',
                'restaurants' => []
                ],
                [
                'name' => 'discover',
                'restaurants' => []
                ],
                [
                'name' => 'discover',
                'restaurants' => []
                ],

            ],

            'categories' => []
        ];
    }
//"restaurantName":"",
//"restaurantMetro":"",
//"restaurantImage":"https:\/\/baku.cafe\/img\/cafe\/56.jpg",
//"restaurantAvaragePrice":"",
//"restaurantRating":"",
//"isSponsored":"0",
//"restaurantId":"3"
}
