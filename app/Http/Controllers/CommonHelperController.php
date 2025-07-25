<?php

namespace App\Http\Controllers;

use App\Models\EventSchedule;
use App\Models\Helplines;
use App\Models\Notifications;
use Illuminate\Http\Request;

class CommonHelperController extends Controller
{
    public function index(){
        $helpLines  = Helplines::all();
        return response()->json([
            'helpLines' => $helpLines,
        ]);
    }

    public function notification(){
        $notifications = Notifications::where('Active','Y')->get();
        return response()->json([
            'notifications' => $notifications,
        ]);
    }
}
