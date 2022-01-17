<?php
namespace App\Services\Comment;
use App\Comment;

interface Handler{

    public function setNext(Handler $handler);

    public function Handle(Comment $comment);
}
