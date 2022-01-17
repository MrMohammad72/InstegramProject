<?php

namespace App\Services\Comment;

use App\Comment;
use App\CommentState;

class createCommentState extends AbstractHandler
{
    public function handle(Comment $comment){


      CommentState::create([

              'comment_id'=>$comment->id

      ]);

        return parent::handle($comment);
    }
}
