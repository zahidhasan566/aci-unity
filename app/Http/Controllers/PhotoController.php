<?php

namespace App\Http\Controllers;

use App\Models\AwardDetails;
use App\Models\Awards;
use App\Models\Helplines;
use App\Models\Photos;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function awardGalleryIndex(){
        $awards  = Awards::all();
        return response()->json([
            'awards' => $awards,
        ]);
    }
    public function awardGalleryDetails($awardID){
        $award  = AwardDetails::select('AwardDetails.*','Awards.Title')->join('Awards', 'Awards.AwardID', '=', 'AwardDetails.AwardID')->where('AwardDetails.AwardID', '=', $awardID)->get();
        return response()->json([
            'award' => $award,
        ]);
    }

    public function galleryIndex(){
        $photos  = Photos::all();
        return response()->json([
            'photos' => $photos,
        ]);
    }

    public function photoGalleryDetails($photoID){
        $photo  = Photos::select('Photos.*')->where('Photos.PhotoID', '=', $photoID)->first();
        return response()->json([
            'photo' => $photo,
        ]);
    }



}
