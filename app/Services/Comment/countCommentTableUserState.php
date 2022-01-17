<?php
namespace App\Services\Comment;

use App\Comment;

class countCommentTableUserState extends AbstractHandler
{
    public function handle(Comment $comment){

        $comment->user->CountComment();

        return parent::handle($comment);
    }
}
