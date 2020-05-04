<?php

namespace App\Http\Controllers\Api;

use App\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class CollectionController extends Controller
{


    public function getCollection()
    {
        if(Auth::check()) {
            $user = Auth::user();
            $collections = $user->collections()->get();
            return $collections;
        }
        return response(['message' => 'you are not logged in']);
    }



    public function setCollection(Request $request)
    {
        if(Auth::check()) {
            $user = Auth::user();
            $collection = $user->collections()->create(['name' => $request->name]);
            return response(['message' => 'your collection created succesfully']);
        }
        return response(['message' => 'you are not logged in']);

    }



   public function update(Request $request)
    {
        if(Auth::check()) {
            $user = Auth::user();
            $collection = Collection::where('id',$request->id)->update(['name'=> $request->name]);
            return response(['message' => 'your collection updated succesfully']);
        }
        return response(['message' => 'you are not logged in']);

    }

}
