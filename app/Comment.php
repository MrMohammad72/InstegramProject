<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CommentState;
use App\Article;
use App\User;

class Comment extends Model
{

    protected $fillable=[
       'article_id','user_id','body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function article()
    {
      
        return $this->belongsTo(Article::class);
    }

    public function commentState()
    {
        return $this->hasOne(CommentState::class);

    }

    public function leaveComments($request,$id)
    {
       
          return  $this->create([
                'article_id'=>$id,
                'user_id'=>auth('api')->user()->id,
                'body'=>$request->body
            ]);
       
    }

}
