<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelInfo extends Model
{
    use HasFactory;

    protected $table = "TravelInfo";
    public $primaryKey = 'TravelID';
    protected $guarded = [];
    public $timestamps = false;
}
