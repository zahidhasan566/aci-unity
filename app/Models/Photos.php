<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;

    protected $table = "Photos";
    public $primaryKey = 'PhotoID';
    protected $guarded = [];
    public $timestamps = false;
}
