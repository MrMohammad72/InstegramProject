<?php
namespace App\Services\Implementation;
interface Handler{

    public function setNext(Handler $handler);

    public function Handle(\App\Article $article);
}

