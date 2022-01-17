<?php

namespace App\Services\Implementation;

use App\Article;

class ImplementationAplire {

    public function applay(Article $article)
    {
        //dd($article);
        $createPostState = resolve(createPostState::class);
        $IncrementCountArticle = resolve(IncrementCountArticle::class);
        $IncrementCountArticle->setNext( $createPostState);
        $IncrementCountArticle->handle($article);

    }

}
