<?php

namespace App\Services\Implementation;


use App\Article;
use App\PostState;
use App\Services\Implementation;

abstract class  AbstractHandler implements Handler {

    private $NextHandler;

    public function setNext(Handler $handler)
    {
        $this->NextHandler=$handler;
        return $handler;

    }

    public function handle(Article $article)
    {
        if ( $this->NextHandler){
            return $this->NextHandler->handle($article);
        }
        return null;
    }



}
