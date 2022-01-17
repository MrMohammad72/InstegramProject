<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    const NAME_MIN_LENGTH = 5;
    protected $fillable = [
        'user_id' ,'title', 'description', 'image', 'like_article'
    ];
    /**
     * @var mixed
     */


    /**
     * @var mixed
     */

    public function articleState()
    {
            return $this->hasOne(ArticleState::class);
    }

    public function user()
    {

             return $this->belongsTo(User::class);
    }

    public function CountComment()
    {

            $this->articleState->count_comment++;
            $this->articleState->save();
      
    }

    public function incrementCountLike()
    {
      
            $this->articleState->count_like++;
            $this->articleState->save();
   
    }

    public function scopeSearch($query)
    {
           $query->where('user_id',auth('api')->user()->id);
    }

    public function searchArticle($request)
    {

           return $search=$this->Search()->where('title','like',"%{$request->search}%")->get();

           
    }

    public function add($request)
    {  
         return   $this::create([
                'user_id'=>auth('api')->user()->id,
                'title'=>$request->title,
                'description'=>$request->description,
                'image'=>$request->image
            ]); 
    }

    public function edit($request,$id)
    {
            $article= $this::find($id);
           return $article->update($request->all());
    }

    public function remove($request)
    {
        $this::findOrFail($request)->delete();
        return true;
    }

    public function show($request)
    {
        
           return $article=$this::where('id','like',$request)->get();

    }

    public function searchArticles($request)
    {
       
            $search=$this->where('title','like',"%{$request->search}%")->with('articleState')->get();
            return $search->sortByDesc('count_like');
        
    }

    public function searchArticleStore($request)
    {
       
        return $this::UserAuth()->where('title','like',"%{$request->search}%")->get();
    
        
    }

    public function scopeUserAuth($query)
    {
      return $query->where('user_id',auth('api')->user()->id);
    }
}
