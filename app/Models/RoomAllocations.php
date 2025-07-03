<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAllocations extends Model
{
    use HasFactory;

    protected $table = "RoomAllocations";
    public $primaryKey = 'AllocationID';
    protected $guarded = [];
    public $timestamps = false;


    public function room()
    {
        return $this->belongsTo(Rooms::class, 'RoomID');
    }

}

