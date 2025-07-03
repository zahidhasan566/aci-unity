<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    use HasFactory;

    protected $table = "EventSchedule";
    public $primaryKey = 'ScheduleID';
    protected $guarded = [];
    public $timestamps = false;

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'SessionID', 'ScheduleID');
    }
}
