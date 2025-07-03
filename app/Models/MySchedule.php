<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MySchedule extends Model
{
    use HasFactory;

    protected $table = "MySchedule";
    public $primaryKey = 'MyScheduleID';
    protected $guarded = [];
    public $timestamps = false;
}
