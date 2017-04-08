<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collections';
    protected $primaryKey = 'collection_id';
    public $timestamps = false;
    protected $guarded = [];
}
