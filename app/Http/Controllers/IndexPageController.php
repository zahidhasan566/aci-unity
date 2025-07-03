<?php

namespace App\Http\Controllers;

use App\Models\Awards;
use App\Models\EventSchedule;
use App\Models\Hotels;
use App\Models\Photos;
use App\Traits\UserHotelHelper;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    use UserHotelHelper;
    public function index(){
        $userId = auth()->user()->UserId;

        $hotelInfo = $this->getHotelInfoByUser($userId);
        $eventInfo = EventSchedule::all();
        $awards = Awards::all();
        $gallery  = Photos::all();


        return response()->json([
            'hotelInfo' => $hotelInfo,
            'eventInfo' => $eventInfo,
            'awards' => $awards,
            'gallery' => $gallery,
        ]);


    }
}
