<?php

namespace App\Http\Controllers;

use App\Models\Awards;
use App\Models\EventSchedule;
use App\Models\Hotels;
use App\Models\Photos;
use App\Models\TravelInfo;
use App\Traits\UserHotelHelper;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    use UserHotelHelper;
    public function index(){
        $userId = auth()->user()->UserId;



        $hotelInfo = $this->getHotelInfoByUser($userId);
        $eventInfo = EventSchedule::select('EventSchedule.*')->OrderBy('EventDate','asc')->get();
        $awards = Awards::all();
        $gallery  = Photos::all();
        $travelInfo  =  TravelInfo::where('UserId',$userId)->first();
        $checkIn =  !empty($travelInfo->ArrivalTime) ? 'checkIn' : null;
        $checkingDone=  !empty($travelInfo->DepartureTime) ? true : null;


        return response()->json([
            'hotelInfo' => $hotelInfo,
            'eventInfo' => $eventInfo,
            'awards' => $awards,
            'gallery' => $gallery,
            'checkIn' => $checkIn,
            'checkingDone' => $checkingDone,
        ]);


    }
}
