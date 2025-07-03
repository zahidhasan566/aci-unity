<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;

    protected $table = "Hotels";
    public $primaryKey = 'HotelID';
    protected $guarded = [];
    public $timestamps = false;
}
