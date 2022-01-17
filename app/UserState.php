<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserState extends Model
{

    protected $fillable=['user_id','count_article','count_comment',
     'count_follower','count_following'];
}
