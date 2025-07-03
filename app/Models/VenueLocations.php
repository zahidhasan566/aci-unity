<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueLocations extends Model
{
    use HasFactory;

    protected $table = "VenueLocations";
    public $primaryKey = 'LocationID';
    protected $guarded = [];
    public $timestamps = false;
}
