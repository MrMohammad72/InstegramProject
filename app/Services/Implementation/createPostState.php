<?php

namespace App\Services\Implementation;

use App\Article;
use App\ArticleState;
use App\PostState;

class createPostState extends AbstractHandler{

    public function handle(Article $article)
    {
        ArticleState::create([
            'article_id'=>$article->id
        ]);
            return parent::handle($article);


    }
}
