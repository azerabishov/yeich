<?php

namespace App\Http\Controllers\Api;

use App\Reservation;
use App\Restaurant;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Psr7\str;


class ReservationController extends Controller
{

    public function reservationIndexPage(Request $request)
    {
        $room_id          = $request->room_id;
        $room_info        = Room::find($room_id)->with('restaurant')->get();
        $open_time        = $room_info[0]->restaurant;
        $close_time       = $room_info[0]->restaurant->close_time;
        $hours = array();
        $open_time = strtotime($open_time);
        while (date('H:i', $open_time) != date('H:i', strtotime("-165 minutes", strtotime($close_time)))) {
            array_push($hours, date('H:i', $open_time));
            $open_time = strtotime('+15 minutes', $open_time);
        }
        return response(['number_of_person'=>$room_info[0]->number_of_person,'hours' => $hours]);
    }



    public function check(Request $request) {
        $reservation_begin = $request->begin;
        $reservation_end   = $request->finish;
        $number_of_person  = $request->person_count;
        $room_id           = $request->room_id;
        $restaurant_id     = $request->id;
        $reservation_date  = $request->date;

        $reservation_data = Reservation::query()
            ->where('reservation_date',$reservation_date)
            ->where('restaurant_id', $restaurant_id)
            ->where('room_id', $room_id)
            ->select(['begin','end'])->get()->toArray();


        foreach ($reservation_data as $date){
            if ((date('H:i', strtotime($reservation_begin)) < date('H:i', strtotime($date['begin'])) and
                date('H:i', strtotime($reservation_end)) < date('H:i', strtotime($date['begin']))) or
                (date('H:i', strtotime($reservation_begin)) > date('H:i', strtotime($date['end'])) and
                date('H:i', strtotime($reservation_end)) > date('H:i', strtotime($date['end']))))
            {
                return response(['date'=>$reservation_date,'begin'=>$reservation_begin,'end'=>$reservation_end,'person_count'=>$number_of_person]);
            }
        }

        return response(['message' => 'change reservation time']);

    }


    public function reserv(Request $request)
    {
        $user_id           = $request->user_id;
        $room_id           = $request->room_id;
        $restaurant_id     = $request->id;
        $reservation_begin = $request->begin;
        $reservation_end   = $request->finish;
        $reservation_date  = $request->date;

        $request->guest_note? $guest_note = $request->guest_note: null;

        Reservation::create([
            'restaurant_id' => $restaurant_id,
            'room_id' => $room_id,
            'user_id' => $user_id,
            'reservation_date' => $reservation_date,
            'begin' => $reservation_begin,
            'end' => $reservation_end,
            'status'=>1,
            'guest_note' => $guest_note,
        ]);

        return response(['message'=>'reservation added']);
    }


}
