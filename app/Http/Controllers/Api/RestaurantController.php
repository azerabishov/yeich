<?php

namespace App\Http\Controllers\Api;

use App\Collection;
use App\Http\Resources\OfferResource;
use App\Http\Resources\RatingResource;
use App\Http\Resources\RestaurantDetailResource;
use App\Http\Resources\RestaurantResource;
use App\Image;
use App\Offer;
use App\Restaurant;
use App\Save;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RestaurantController extends Controller
{

    public function addToCollection(Request $request)
    {
        if(Auth::check()) {
            $collectionid = $request->collectionid;
            $collection = Collection::find($collectionid);
            $restaurantid = $request->id;
            $restaurant = Restaurant::find($restaurantid);
            echo $restaurant;
            $restaurant->collections()->attach($collectionid);
            $collection->update(['image'=>$restaurant->image]);
            return response(['message'=>'success']);
        }
        return response(['message' => 'you are not logged in']);
    }



    public function removeFromCollection(Request $request)
    {
        $collectionid = $request->collectionid;
        $collection = Collection::find($collectionid);
        $restaurantid = $request->id;
        $restaurant = Restaurant::find($restaurantid);
        $restaurant->collections()->detach($collectionid);
        if(DB::table('collection_restaurant')->count()>0){
            $last  = DB::table('collection_restaurant')->latest('id')->first();
            $lastRestaurantID = $last->restaurant_id;
            $lastRestaurant  = Restaurant::find($lastRestaurantID);
            $collection->update(['image'=>$lastRestaurant->image]);
            return response(['message'=>'your saved removed correctly']);
        }
        $collection->update(['image'=>'salam.png']);
        return response(['message'=>'your saved removed correctly']);
    }



    public function restaurantDetail(Request $request)
    {
        RestaurantDetailResource::withoutWrapping();
        return new RestaurantDetailResource($request);
    }





    public function getRatingDetail(Request $request)
    {
        return new RatingResource($request);
    }



    public function getRooms(Request $request)
    {
        $restaurant_id = $request->id;
        $rooms = Restaurant::where('id',$restaurant_id)->with('rooms')->get();
        return response(['rooms_data'=>$rooms[0]->rooms]);

    }



    public function getMainHalls(Request $request)
    {
        $restaurant_id = $request->id;
        $rooms = Restaurant::where('id',$restaurant_id)->with('mainhalls')->get();
        return response(['mainhalls_data'=>$rooms[0]->rooms]);
    }

}
