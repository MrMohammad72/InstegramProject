<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleState extends Model
{
    protected $fillable = ['article_id', 'count_like', 'count_comment'];

}
