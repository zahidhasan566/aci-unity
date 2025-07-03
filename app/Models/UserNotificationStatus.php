<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotificationStatus extends Model
{
    use HasFactory;

    protected $table = "UserNotificationStatus";
    public $primaryKey = 'NotificationStatusID';
    protected $guarded = [];
    public $timestamps = false;
}
