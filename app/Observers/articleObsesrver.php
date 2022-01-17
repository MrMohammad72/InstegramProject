<?php

namespace App\Observers;

use App\Article;
use App\Services\Implementation\ImplementationAplire;

class articleObsesrver
{
    /**
     * Handle the article "created" event.
     *
     * @param  \App\Article  $article
     * @return void
     */
    public function created(Article $article)
    {
        resolve(ImplementationAplire::class)->applay($article);
    }

    
}
