<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Hashtag  extends Model
{

    protected $fillable=['user_id','body'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function hashtagState()
    {

        return $this->hasOne(HashtagState::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class)->withTimestamps();
    }
    public function incrementCountHashtag()
    {

        $this->hashtagState->count_hashtag++;
        $this->hashtagState->save();

    }

    public function store($request)
    {
       
       $this->create([
        'user_id'=>auth('api')->user()->id,
        'body'=>$request
       ]);
     return true;
    }

    public function add($article,$hashtag)
    {
       
        $array =
            ['article_id' =>$article,'hashtag_id' => $hashtag, 'created_at'=>carbon::now()]
        ;

         DB::table('articles_hashtags')->insertOrIgnore($array);
        return true;
    }



    public function index($request)
    {  
    return DB::table('articles_hashtags')->where('article_id',$request)->get();
      
    }

    public function search($request)
    {
         
    return DB::table('articles_hashtags')->where('hashtag_id',$request)->get();
    }


    public function remove($request)
    {
    return DB::table('articles_hashtags')->where('hashtag_id',$request)->delete();
    }

    public function show($request)
    {

    return DB::table('hashtag_states')->where('created_at','>=',new Carbon('-2 days'))->orderBydesc('count_hashtag','>=',2)->get();

    }

}
