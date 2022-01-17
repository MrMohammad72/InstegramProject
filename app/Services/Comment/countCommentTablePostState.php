<?php
namespace App\Services\Comment;

use App\Comment;

class countCommentTablePostState extends AbstractHandler
{

    public function handle(Comment $comment){


        $comment->article->CountComment();


        return parent::handle($comment);
    }
}
