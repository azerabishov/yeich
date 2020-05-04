<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CommentResource;
use App\Http\Resources\RatingResource;
use App\Http\Resources\RestaurantOfferResource;
use App\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{

    public function comment(Request $request)
    {
        return new RatingResource($request);
    }

    public function offer(Request $request)
    {
        return new RestaurantOfferResource($request);
    }
}
