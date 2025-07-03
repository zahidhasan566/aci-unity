<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helplines extends Model
{
    use HasFactory;

    protected $table = "Helplines";
    public $primaryKey = 'HelplineID';
    protected $guarded = [];
    public $timestamps = false;
}
