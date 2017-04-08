<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affair extends Model
{
    protected $table = 'affairs';
    protected $primaryKey = 'affair_id';
    public $timestamps = false;
    protected $guarded = [];
}
