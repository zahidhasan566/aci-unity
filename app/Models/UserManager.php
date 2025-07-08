<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserManager extends  Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "UserManager";
    public $timestamps = false;
    public $primaryKey = 'UserId';
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = "string";
    protected $connection = 'sqlsrv';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getGuardName()
    {
        return $this instanceof \App\Models\UserManager ? 'api_second' : 'api';
    }
    public function getJWTCustomClaims() {
        return ['guard' => 'api_second'];
    }
    public function roles()
    {
        return $this->hasOne(Role::class,'RoleID','RoleID');
    }
    public function userSubmenu()
    {
        return $this->hasMany(SubMenuPermission::class,'UserID','UserId');
    }
    public function roomAllocation()
    {
        return $this->hasOne(RoomAllocations::class, 'UserId', 'UserId'); // or 'UserId' if string
    }
}
