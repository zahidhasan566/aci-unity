<?php

namespace App\Http\Controllers;

use App\Models\Awards;
use App\Models\EventSchedule;
use App\Models\Photos;
use App\Traits\UserHotelHelper;
use Illuminate\Http\Request;

class HotelRoomController extends Controller
{
    use UserHotelHelper;
    public function index(){
        $userId = auth()->user()->UserId;
        $hotelInfo = $this->getHotelInfoByUser($userId);
        return response()->json([
            'hotelInfo' => $hotelInfo,
        ]);


    }
}
