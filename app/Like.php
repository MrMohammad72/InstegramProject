<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Like extends Model
{
    protected $fillable=['user_id','article_id'];

    public function incrementCont_like($request)
    {
        $postState = ArticleState::where('article_id', $request)->first();
        $postState->count_like++;
        $postState->save();
    }

    public function incrementCommentCont_like($request)
    {
        $commentState = CommentState::where('comment_id', $request->comment_id)->first();
        $commentState->count_like++;
        $commentState->save();
    }

    public function like($request)
    {
        
            $array = [
                ['user_id' =>auth('api')->user()->id, 'article_id' =>$request],
            ];
            if (  DB::table('likes')->insertOrIgnore($array)){

                return true;
            }return false;
    }
    public function likeComment($request)
    {
            $array = [
                ['user_id' =>auth('api')->user()->id, 'comment_id' =>$request],
            ];
            if (  DB::table('like_comment')->insertOrIgnore($array)){
                return true;
            }return false;
       
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

}
