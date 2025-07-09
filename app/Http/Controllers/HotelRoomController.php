<?php

namespace App\Http\Controllers;

use App\Models\Awards;
use App\Models\EventSchedule;
use App\Models\Hotels;
use App\Models\Photos;
use App\Models\RoomAllocations;
use App\Traits\UserHotelHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HotelRoomController extends Controller
{
    use UserHotelHelper;
    public function index(){
        $userId = auth()->user()->UserId;
        $hotelInfoUserWise = $this->getHotelInfoByUser($userId);
        $hotelInfo = RoomAllocations::select(
            'RoomAllocations.RoomID',
            'RoomAllocations.UserId',
            'Rooms.RoomNumber',
            'Rooms.RoomType',
            'Hotels.HotelName',
            'Hotels.Address',
            'Hotels.GoogleMapLink'
        )
            ->join('Rooms', 'Rooms.RoomID', '=', 'RoomAllocations.RoomID')
            ->join('Hotels', 'Hotels.HotelID', '=', 'Rooms.HotelID')
            ->get()
            ->map(function ($item) {
                $item->UserId = (string) $item->UserId; // Force string here
                return $item;
            });

        $users = collect();

        $userIds = $hotelInfo->pluck('UserId')->unique()->values()->all();
        Log::info("All User IDs to find", $userIds);

        foreach (array_chunk($userIds, 1000) as $chunk) {
            // Step 1: Try pharmaSqlSrv first
            $pharmaUsers = DB::connection('pharmaSqlSrv')
                ->table('UserManager')
                ->select('UserId', 'UserName')
                ->whereIn('UserId', $chunk)
                ->get()
                ->mapWithKeys(fn ($u) => [(string) $u->UserId => $u]);

            foreach ($pharmaUsers as $id => $user) {
                $users->put((string)$id, $user); // ✅ preserves string key
            }

            // Step 2: Find missing UserIds not found in pharma
            $missingUserIds = array_diff($chunk, $pharmaUsers->keys()->toArray());

            if (!empty($missingUserIds)) {
                $fallbackUsers = DB::connection('sqlsrv') // fallback DB
                ->table('UserManager')
                    ->select('UserId', 'UserName')
                    ->whereIn('UserId', $missingUserIds)
                    ->get()
                    ->mapWithKeys(fn ($u) => [(string) $u->UserId => $u]);

                foreach ($fallbackUsers as $id => $user) {
                    $users->put((string)$id, $user); // ✅ again, retain key
                }
            }
        }
        Log::info("Final fetched users:", $users->pluck('UserName', 'UserId')->toArray());
        // Step 3: Attach UserName
        $results = collect($hotelInfo)->map(function ($item) use ($users) {
            $userId = (string) $item->UserId;

            if (!isset($users[$userId])) {
                Log::warning("UserId not found:", [$userId]);
            }

            $item->UserName = $users[$userId]->UserName ?? 'Unknown';
            return $item;
        });

        return response()->json([
            'hotelInfo' => $results,
            'hotelInfoUserWise' => $hotelInfoUserWise,
        ]);


    }
}
