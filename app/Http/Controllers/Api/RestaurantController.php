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
        }
        $collection->update(['image'=>'salam.png']);
    }



    public function restaurantDetail(Request $request)
    {
        RestaurantDetailResource::withoutWrapping();
        return new RestaurantDetailResource($request);
    }


    public function filter(Request $request)
    {
        $data = Restaurant::query();

        if (request()->has('s')){
            $search_key = "%".$request->s."%";
            $data = $data->where('name','like',$search_key);
        }

        if(request()->has('categories') or request()->has('features') or  request()->has('cuisen')){
            $categories =  $request->has('categories') ? explode(',',$request->categories) : [];
            $features = $request->has('features') ? explode(',',$request->features) : [];
            $cuisen = $request->has('cuisen') ?  explode(',',$request->cuisen) : [];

            $types = array_merge($categories,$features,$cuisen);

            $types = array_map('intval',$types);
            $query = "id > 0 and ";
            foreach ($types as $type){
                $query .= "categories like '%,$type,%' and ";
            }
            $query = rtrim($query,'and ');
            $data = $data->whereRaw($query);
        }
        return $data->get();

    }






    public function search(Request $request,Restaurant $restaurant)
    {
        $search_key = "%".$request->s."%";
        $restaurantData = $restaurant->where('name','like',$search_key)->get();
        if ($restaurantData->count()>0){
            return $restaurantData;
        }else{
            return response(['message'=>"data not found"]);
        }
    }


    public function getRatingDetail(Request $request)
    {
        return new RatingResource($request);
    }

}
