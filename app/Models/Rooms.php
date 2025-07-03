<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $table = "Rooms";
    public $primaryKey = 'RoomID';
    protected $guarded = [];
    public $timestamps = false;

    public function hotel()
    {
        return $this->belongsTo(Hotels::class, 'HotelID');
    }

}
