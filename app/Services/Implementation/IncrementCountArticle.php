<?php

namespace App\Services\Implementation;

use App\Article;
use App\PostState;

class IncrementCountArticle extends AbstractHandler{

    public function handle(Article $article){

            $article->user->incrementArticle();

        return parent::handle($article);
    }
}
