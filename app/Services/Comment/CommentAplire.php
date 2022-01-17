<?php

namespace  App\Services\Comment;

use App\Comment;
use App\Services\Implementation\createPostState;
use App\Services\Implementation\IncrementCountArticle;

class CommentAplire {
    public function applay(Comment $comment)
    {
        //dd($comment);
        $userState = resolve(countCommentTableUserState::class);
        $postState = resolve(countCommentTablePostState::class);
        $commentState = resolve(createCommentState::class);
        $commentState ->setNext($userState)->setNext($postState);
        $commentState->handle($comment);

    }
}
