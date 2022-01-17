<?php

namespace App\Services\Comment;

use App\Comment;
use App\Services\Comment\Handler;

abstract class AbstractHandler implements Handler {

    private $NextHandler;
    public function setNext(Handler $handler)
    {
        $this->NextHandler=$handler;
        return $handler;

    }

    public function handle(Comment $comment)
    {
        if ( $this->NextHandler){
            return $this->NextHandler->handle($comment);
        }
        return null;
    }


}
