<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentState extends Model
{
    protected $fillable = ['comment_id', 'count_like'];
}
