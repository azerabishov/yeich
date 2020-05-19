<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter(Request $request)
    {

        $data = Restaurant::query();

        if ($request->has('s')){
            $search_key = "%".$request->s."%";
            $data = $data->where('name','like', $search_key);
        }

        if($request->has('categories') or $request->has('features') or $request->has('cuisen')){
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

}
