<?php

namespace App\Observers;

use App\Comment;
use App\Services\Comment\CommentAplire;

class commentObsesrver
{
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
       
        resolve(CommentAplire::class)->applay($comment);
    }

}
