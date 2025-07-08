<?php

namespace App\Traits;

use App\Models\RoomAllocations;

trait UserHotelHelper
{
    public function getHotelInfoByUser($userId)
    {
        $allocation = RoomAllocations::select('RoomAllocations.*','TravelInfo.ArrivalTime','TravelInfo.DepartureTime')->with('room.hotel')
            ->leftJoin('TravelInfo', 'TravelInfo.UserId', '=', 'RoomAllocations.UserId')
            ->where('RoomAllocations.UserId', $userId)
            ->first();

        if (!$allocation || !$allocation->room || !$allocation->room->hotel) {
            return null;
        }

        return [
            'user_id' => $userId,
            'hotel' => [
                'name' => $allocation->room->hotel->HotelName,
                'address' => $allocation->room->hotel->Address,
                'map' => $allocation->room->hotel->GoogleMapLink,
                'check_in' => !empty($allocation->TravelInfo->ArrivalTime) ? $allocation->TravelInfo->ArrivalTime : null,
                'check_out' => !empty($allocation->TravelInfo->DepartureTime) ? $allocation->TravelInfo->DepartureTime : null,
                'facilities' => $allocation->room->hotel->Facilities,
                'rules' => $allocation->room->hotel->Rules,
            ],
            'room' => [
                'number' => $allocation->room->RoomNumber,
                'type' => $allocation->room->RoomType,
            ]
        ];
    }
    public function getAllHotelInfo()
    {
        $allocation = RoomAllocations::with('room.hotel')
            ->get();

        if (!$allocation || !$allocation->room || !$allocation->room->hotel) {
            return null;
        }

        return [
            'hotel' => [
                'name' => $allocation->room->hotel->HotelName,
                'address' => $allocation->room->hotel->Address,
                'map' => $allocation->room->hotel->GoogleMapLink,
                'check_in' => $allocation->room->hotel->CheckIn,
                'check_out' => $allocation->room->hotel->CheckOut,
                'facilities' => $allocation->room->hotel->Facilities,
                'rules' => $allocation->room->hotel->Rules,
            ],
            'room' => [
                'number' => $allocation->room->RoomNumber,
                'type' => $allocation->room->RoomType,
            ]
        ];
    }
}
