<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Offer;
use App\Restaurant;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function getOffers(Request $request)
    {
        OfferResource::withoutWrapping();
        return new OfferResource($request);

    }

}
