<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentForward extends Model
{
    protected $table = 'comment_forwards';
    protected $primaryKey = 'forward_id';
    public $timestamps = false;
    protected $guarded = [];
}
