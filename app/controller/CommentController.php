<?php
namespace App\Http\Controllers;


use App\Comment;
use App\Like;
use App\Services\Validate\validate;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $validate;
    private $comment;
    public function __construct(validate $validate,Comment $comment)
    {
        $this->validate=$validate;
        $this->comment=$comment;
    }
      
    public function likeComment(Like $likes,$request )                  /*   like article*/
    { 
        if ($this->validate->validateCommentLike($request)) {
            $like=$likes->likeComment($request);
            if ($like) {
                return response()->json(['message' => 'ok', 'state' => 200, 'like'=>['user_id'=>auth('api')->user()->id,'comment_id'=>$request]]);
            }return response()->json(['message' => 'erorr dublicate', 'state' => 500]);
        }return response()->json(['message' => 'erorr', 'state' => 400]);

     }
    public function leaveComments(Request $request,$id)
        {
           
            $firstValidate= $this->validate->validateInputArticle($id);
            if ($firstValidate) {
                $secondValidate= $this->validate->validateComment($request);
                 if ($secondValidate) {
                  $edit=$this->comment->leaveComments($request,$id);
                   if ($edit) {
                    return response()->json(['message' => 'success', 'state' => 200,'comment'=>[
                        'article_id'=>$edit->article_id,
                        'user_id'=>$edit->user_id,
                        'body'=>$edit->body
                    ]]);
                   }else{
                    return response()->json(['message' => 'error', 'state' => 500]);
                   }
                 }     
            }else{
                return response()->json(['message' => 'erorr', 'state' => 400]);
            }
        }
}